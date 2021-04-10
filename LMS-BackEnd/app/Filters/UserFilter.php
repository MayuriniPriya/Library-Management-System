<?php

namespace App\Filters;

class UserFilter extends Filter
{
    /**
     * @var array
     */
    protected $fields = [
        'name', 'email'
    ];
}
