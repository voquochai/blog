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

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('admin')->namespace('Backend')->name('admin.')->group(function () {
	Auth::routes();
	Route::middleware('auth')->group(function () {
		Route::get('/', 'DashboardController@index')->name('dashboard');
		
		Route::resources([
			'users' => 'UserController',
			'categories' => 'CategoryController',
		]);

		Route::post('users/status', 'UserController@status')->name('users.status');
		Route::post('users/priority', 'UserController@priority')->name('users.priority');

		Route::post('categories/status', 'CategoryController@status')->name('categories.status');
		Route::post('categories/priority', 'CategoryController@priority')->name('categories.priority');
	});
});


Route::get('/home', 'HomeController@index')->name('home');
