<?php

namespace App\Repositories;

use App\Contracts\Repositories\Repository as RepositoryContract;
use Closure;

abstract class Repository implements RepositoryContract
{
     /**
     * Eloquent class name
     * @var string
     */
    protected string $model;

    /**
     * Eloquent order by latest
     * @var string
     */
    protected $latest;

    /**
     * Where items
     * @var array
     */
    private $where = [];

    /**
     * WhereHas items
     * @var array
     */
    private  $whereHas = [];

    /**
     * with items
     * @var array
     */
    private $with = [];

    /**
     * with count items
     * @var array
     */
    private $withCount = [];

    /**
     * Add order by desc to query builder.
     *
     * @param string $column
     * @return self
     */
    public function latest(string $column = 'id')
    {
        $this->latest = $column;
        return $this;
    }

    /**
     * Add relations to query builder.
     *
     * @param array $relations
     * @return self
     */
    public function with(array $relations)
    {
        $this->with[] = $relations;
        return $this;
    }

    /**
     * Add relations count to query builder.
     *
     * @param array $relations
     * @return self
     */
    public function withCount(array $relations)
    {
        $this->withCount[] = $relations;
        return $this;
    }

    /**
     * Get query where.
     *
     * @param string $field
     * @param string|number $condition
     * @param string|number $value
     * @return self
     * @throws
     */
    public function where(string $field, $condition, $value = null)
    {
        $this->where[] = [$field, $condition, $value];
        return $this;
    }

    /**
     * Get query where function.
     *
     * @param \Closure $closure
     * @return self
     * @throws
     */
    public function whereFn(Closure $closure)
    {
        $this->where[] = [$closure];
        return $this;
    }

    /**
     * Where has relation.
     *
     * @param string $relation
     * @param Closure $closure
     * @return self
     */
    public function whereHas(string $relation, Closure $closure)
    {
        $this->whereHas[$relation] = $closure;
        return $this;
    }

    /**
     * Get item by given identifier.
     *
     * @param int $id
     * @param array|mixed $columns
     * @return mixed
     */
    public function find($id, array $columns = ['*'])
    {
        return $this->findWhere('id', $id, $columns);
    }

    /**
     * Get item by given colum value.
     *
     * @param string $column
     * @param string $value
     * @param array|mixed $columns
     * @return mixed
     */
    public function findWhere($column, $value, array $columns = ['*'])
    {
        return $this->query()->where($column, $value)->select($columns)->first();
    }

    /**
     * Get item by given identifier or throw not found exception.
     *
     * @param int $id
     * @param array|mixed $columns
     * @return mixed
     * @throws
     */
    public function findOrFail($id, array $columns = ['*'])
    {
        return $this->findWhereOrFail('id', $id, $columns);
    }

    /**
     * Get item by given colum value or throw not found exception.
     *
     * @param string $column
     * @param string $value
     * @param array|mixed $columns
     * @return mixed
     * @throws
     */
    public function findWhereOrFail($column, $value, array $columns = ['*'])
    {
        return $this->query()->where($column, $value)->select($columns)->firstOrFail();
    }

    /**
     * Get all of the records from the database.
     *
     * @param array|mixed $with
     * @param array|mixed $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all(array $with = [], array $columns = ['*'])
    {
        return $this->query()->select($columns)->get();
    }

    /**
     * Get paginated records from the database.
     *
     * @param int $itemsPerPage
     * @param string|null $query
     * @param array|mixed|string[] $columns
     * @return Repository[]|\Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    public function pagination(int $itemsPerPage, string $query = null, array $columns = ['*'])
    {
        return $this->filterQuery($query)->select($columns)->latest('id')->paginate($itemsPerPage);
    }

    /**
     *  Create new item with given values.
     *
     * @param array $values
     * @return mixed\
     */
    public function create(array $values)
    {
        return $this->model::create($values);
    }

    /**
     * Update item by given values or throw not found exception.
     *
     * @param int $id
     * @param array $columns
     * @return mixed
     * @throws
     */
    public function update($id, array $values)
    {
        return $this->findOrFail($id)->update($values);
    }

    /**
     * Delete item by given values or throw not found exception.
     *
     * @param int $id
     * @return mixed
     * @throws
     */
    public function delete($id)
    {
        return $this->findOrFail($id)->delete();
    }

    /**
     * Get query builder.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function query()
    {
        $builder = (new $this->model)->on();

        // Apply with items
        foreach ($this->with as $with) {
            $builder->with($with);
        }

        // Apply with count items
        foreach ($this->withCount as $withCount) {
            $builder->withCount($withCount);
        }

        // Apply with count items
        foreach ($this->where as $where) {
            $builder->where(...$where);
        }

        // Apply whereHas items
        foreach ($this->whereHas as $relation => $closure) {
            $builder->whereHas($relation, $closure);
        }

        if ($this->latest) {
            $builder->latest($this->latest);
        }

        // Cleanup items
        $this->with = [];
        $this->where = [];
        $this->whereHas = [];
        $this->withCount = [];
        $this->latest = null;

        return $builder;
    }

    /**
     * Get filter query builder.
     *
     * @param string|null $searchQuery
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function filterQuery(string $searchQuery = null)
    {
        $builder = $this->query();

        if ($filter = $this->model::$filter ?? null) {
            $builder->where(function ($query) use ($filter, $searchQuery) {
                return resolve($filter)->handle(
                    $query,
                    $searchQuery
                );
            });
        }

        return $builder;
    }

    /**
     * @param string|null $q
     * @param string $label
     * @return array
     */
    public function search(string $q = null, string $label = 'name')
    {
        $except = request()->get('except');
        $query = $this->query();
        if ($except) {
            $except = explode(",", $except);
            $query = $query->whereNotIn('id', $except);
        }
        if ($q == null) {
            $values = $query->get()->take(10)->toArray();
        } else {
            $values = $query->where($label, 'LIKE', '%' . $q . '%')->get()->take(10)->toArray();
        }
        $values = array_map(function ($obj) use ($label) {
            return ["name" => $obj[$label], "value" => $obj['id']];
        }, $values);
        return ["success" => true, "data" => $values];
    }
}
