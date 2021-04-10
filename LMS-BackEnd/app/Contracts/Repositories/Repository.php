<?php

namespace App\Contracts\Repositories;

use Closure;

interface Repository
{
    /**
     * Get paginated records from the database.
     *
     * @param int|null $itemsPerPage
     * @param string|null $query
     * @param array|mixed $columns
     * @return static[]|mixed
     */
    public function pagination(int $itemsPerPage, string $query = null, array $columns = ['*']);


    /**
     * Get all of the records from the database.
     *
     * @param array|mixed $columns
     * @return static[]|mixed
     */
    public function all(array $columns = ['*']);

    /**
     * Create new item with given values.
     *
     * @param array $values
     * @return mixed
     */
    public function create(array $values);

    /**
     * Get item by given identifier.
     *
     * @param int $id
     * @param array|mixed $columns
     * @return mixed
     */
    public function find($id, array $columns = ['*']);

    /**
     * Get item by given colum value.
     *
     * @param string $column
     * @param string $value
     * @param array|mixed $columns
     * @return mixed
     */
    public function findWhere($column, $value, array $columns = ['*']);

    /**
     * Get item by given identifier or throw not found exception.
     *
     * @param int $id
     * @param array|mixed $columns
     * @return mixed
     * @throws
     */
    public function findOrFail($id, array $columns = ['*']);

    /**
     * Get item by given colum value or throw not found exception.
     *
     * @param string $column
     * @param string $value
     * @param array|mixed $columns
     * @return mixed
     * @throws
     */
    public function findWhereOrFail($column, $value, array $columns = ['*']);



    /**
     * Add order by desc to query builder.
     *
     * @param string $column
     * @return self
     */
    public function latest(string $column = 'id');

    /**
     * Add relations to query builder.
     *
     * @param array $relations
     * @return self
     */
    public function with(array $relations);

    /**
     * Add relations count to query builder.
     *
     * @param array $relations
     * @return self
     */
    public function withCount(array $relations);

    /**
     * Get query where.
     *
     * @param string $field
     * @param string|number $condition
     * @param string|number $value
     * @return self
     * @throws
     */
    public function where(string $field, $condition, $value = null);

    /**
     * Get query where function.
     *
     * @param \Closure $closure
     * @return self
     * @throws
     */
    public function whereFn(Closure $closure);

    /**
     * Get query builder.
     *
     * @param string $relation
     * @param Closure $callback
     * @return self
     * @throws
     */
    public function whereHas(string $relation, Closure $callback);

    /**
     * Update item by given values or throw not found exception.
     *
     * @param int $id
     * @param array $values
     * @return mixed
     * @throws
     */
    public function update($id, array $values);

    /**
     * Delete item by given values or throw not found exception.
     *
     * @param int $id
     * @return mixed
     * @throws
     */
    public function delete($id);

    /**
     * Get search records from the database.
     *
     * @param string|null $q
     * @param string $label
     * @return mixed
     */
    public function search(string $q = null, string $label = 'name');
}
