<?php

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get("/users",'UserController@index');
    $router->get("/users/{id}",'UserController@find');
    $router->post('/auth/register','AuthController@register');
    $router->post('/auth/login','AuthController@login');
    $router->post('/auth/index','AuthController@index');
});
