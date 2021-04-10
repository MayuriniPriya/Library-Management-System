<?php


namespace App\Repositories;

use App\Models\Book;
use \App\Contracts\Repositories\Book as BookContract;

class BookRepository extends Repository implements BookContract
{
    /**
     * @var string
     */
    protected string $model = Book::class;
}
