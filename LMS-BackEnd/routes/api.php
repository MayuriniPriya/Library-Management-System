<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware' => 'auth:api', 'namespace' => "Api"], function (Router $router) {

    /** Auth Related Routes. */
    $router->group(['prefix' => '/user', 'namespace' => "Auth"], function (Router $router) {
        $router->get('/', 'UserController@index');
    });

    /** Setting Related Routes. */
    $router->namespace('Setting')->group(function (Router $router) {
        $router->apiResource('users', 'UserController');
    });

    /** Book Related Routes. */
    $router->namespace('Book')->group(function (Router $router) {
        $router->get('books/search', 'BookController@search');
        $router->apiResource('books', 'BookController');
    });
});
