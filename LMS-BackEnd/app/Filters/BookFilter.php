<?php

namespace App\Filters;

class BookFilter extends Filter
{
    /**
     * @var array
     */
    protected $fields = [
        'title', 'description', 'type', 'price'
    ];
}
