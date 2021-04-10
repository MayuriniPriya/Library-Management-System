<?php

namespace App\Services;

use App\Contracts\Services\Book as BookContract;
use App\Contracts\Repositories\Book;

class BookService extends Service implements BookContract
{
    /**
     * Create a new service instance.
     *
     * BookContract constructor.
     * @param User $user
     */
    public function __construct(Book $book)
    {
        $this->resource = $book;
    }
}
