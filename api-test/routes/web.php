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

// API route group
$router->group(['prefix' => 'api'], function () use ($router) {

    $router->get('users', 'UserController@index');
    $router->get('users/{id}', 'UserController@find');

    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');
    $router->post('logout', 'AuthController@logout');
    $router->post('refresh', 'AuthController@refresh');
    $router->get('profile', 'AuthController@profile');

    $router->get('reports', 'ReportsController@index');
    $router->get('reports/{id}', 'ReportsController@show');
    $router->post('reports', 'ReportsController@myreports');
    $router->post('createreport', 'ReportsController@store');
    $router->put('reports/{id}', 'ReportsController@update');
    $router->delete('reports/{id}', 'ReportsController@destroy');
});
