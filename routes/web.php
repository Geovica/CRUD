<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for 
within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PageController@index');

Route::get('/about', 'PageController@about');

Route::get('/services', 'PageController@services');

Route::resource('posts','PostController');
Auth::routes();

Route::get('/dashboard', 'DashboardController@index');




