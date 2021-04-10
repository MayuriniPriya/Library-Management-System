<?php

namespace App\Contracts\Services;

interface Service
{

       /**
     * Get resources for index use.
     *
     * @param int|null $itemsPerPage
     * @param string|null $query
     * @return mixed
     */
    public function index(int $itemsPerPage = null,string $query = null);

     /**
     * Create new resource.
     *
     * @param array $values
     * @return mixed
     */
    public function create(array $values);

    /**
     * Find resource by id.
     *
     * @param int $resourceId
     * @return mixed
     */
    public function find(int $resourceId);

    /**
     * Get resource for view use.
     *
     * @param int $resourceId
     * @return mixed
     */
    public function view(int $resourceId);

    /**
     * Update resource.
     *
     * @param int $resourceId
     * @param array $values
     * @return mixed
     */
    public function update(int $resourceId, array $values);

    /**
     * Delete resource.
     *
     * @param int $resourceId
     * @return mixed
     */
    public function delete(int $resourceId);

    /**
     * Search resource
     *
     * @param string|null $q
     * @param string $label
     * @return mixed
     */
    public function search(string $q = null, string $label = 'name');
}
