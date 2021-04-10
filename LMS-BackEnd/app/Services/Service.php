<?php

namespace App\Services;

use App\Contracts\Repositories\Repository;

abstract class Service
{
    /**
     * Respository contract
     *
     * @var Repository
     */
    protected Repository $resource;

    /**
     * Get resources for index use.
     *
     * @param int|null $itemsPerPage
     * @param string|null $query
     * @return Repository[]|mixed
     */
    public function index(int $itemsPerPage = null, string $query = null)
    {
        return $this->resource->pagination($itemsPerPage, $query);
    }

    /**
     * Create new resource.
     *
     * @param array $values
     * @return mixed
     */
    public function create(array $values)
    {
        return $this->resource->create($values);
    }

    /**
     * Find resource by id.
     *
     * @param $resourceId
     * @return mixed
     */
    public function find($resourceId)
    {
        return $this->resource->find($resourceId);
    }

    /**
     * Get resource for view use.
     *
     * @param $resourceId
     * @return mixed
     */
    public function view($resourceId)
    {
        return $this->resource->findOrFail($resourceId);
    }

    /**
     * Update resource.
     *
     * @param $resourceId
     * @param array $values
     * @return mixed
     */
    public function update($resourceId, array $values)
    {
        return $this->resource->update($resourceId, $values);
    }

    /**
     * Delete resource.
     *
     * @param $resourceId
     * @return mixed
     */
    public function delete($resourceId)
    {
        return $this->resource->delete($resourceId);
    }

    /**
     * Search resource
     *
     * @param string|null $q
     * @param string $label
     * @return mixed
     */
    public function search(string $q = null, string $label = 'name')
    {
        return $this->resource->search($q, $label);
    }
}
