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

Route::get('/', 'PagesController@index');

Route::get('/about', 'PagesController@about');

Route::resource('posts', 'PostsController');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

Route::post('/dashboard', 'DashboardController@storeCategory');

Route::put('/dashboard', 'DashboardController@updateCategory');

Route::delete('/dashboard', 'DashboardController@deleteCategory');

Route::get('/categories/', 'CategoryController@index');

Route::get('/categories/{id}', 'CategoryController@show');

Route::get('/dashboard/tags', 'TagsController@index');

Route::post('/dashboard/tags', 'DashboardController@storeTag');

Route::put('/dashboard/tags', 'DashboardController@updateTag');

Route::delete('/dashboard/tags', 'DashboardController@deleteTag');

route::get('/tags/{id}', 'TagsController@show');




