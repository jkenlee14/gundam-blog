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

// Auth::routes();

 // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

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

route::any('/archive/', 'PagesController@archive');

route::any('/dashboard/users', 'DashboardController@indexUser');

route::post('/dashboard/users', 'DashboardController@updateUser');




