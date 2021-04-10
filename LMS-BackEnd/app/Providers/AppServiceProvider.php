<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        // Repositories
        \App\Contracts\Repositories\User::class => \App\Repositories\UserRepository::class,
        \App\Contracts\Repositories\Book::class => \App\Repositories\BookRepository::class,

        // Services
        \App\Contracts\Services\User::class => \App\Services\UserService::class,
        \App\Contracts\Services\Book::class => \App\Services\BookService::class
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
