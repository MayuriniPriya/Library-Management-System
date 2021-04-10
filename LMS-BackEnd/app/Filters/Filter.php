<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Filter
{
    /**
     * The attributes that are filterable assignable.
     *
     * @var array
     */
    protected $fields = [];

    /**
     * Handle filter.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param string $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function handle(Builder $builder, string $query = null)
    {
        foreach ($this->fields as $field) {
            $method = 'filter' . Str::title($field);
            if (method_exists($this, $method)) {
                $this->{$method}($builder, $query);
            } else {
                $this->addFilter($builder, $field, $query);
            }
        }

        return $builder;
    }

    /**
     * Add filter field to query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param string $query
     * @param string $field
     * @return void
     */
    protected function addFilter(Builder $builder, string $field, string $query = null)
    {
        $builder->orWhere($field, 'like', "%$query%");
    }
}
