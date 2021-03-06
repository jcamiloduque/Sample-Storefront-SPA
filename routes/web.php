<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix' => 'v1'], function () use ($router) {
    $router->get('products', 'ProductController@getProducts');
    $router->get('product/{id}', 'ProductController@getProduct');
});

/**
 * Always the last route! Loads Vue Application.
 */
$router->get('/{route:.*}/', function () {
    return view('app');
});
