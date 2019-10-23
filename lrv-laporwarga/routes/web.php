<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');
Route::get('/announces', 'AnnouncesController@index');
Route::get('/reports/create', 'ReportsController@create');
Route::post('/reports/create', 'ReportsController@store');
Route::get('/reports/log', 'ReportsController@log');
Route::get('/reports/{report}', 'ReportsController@show');
Route::get('/reports/{report}/edit', 'ReportsController@edit');
Route::patch('/reports/{report}', 'ReportsController@update');
Route::delete('/reports/{report}', 'ReportsController@destroy');

Auth::routes();

// Route::get('/', 'HomeController@index');
