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

		Route::resource('users', 'UserController');
		Route::post('users/status', 'UserController@status')->name('users.status');
		Route::post('users/priority', 'UserController@priority')->name('users.priority');

		Route::resource('categories', 'CategoryController');
		Route::post('categories/status', 'CategoryController@status')->name('categories.status');
		Route::post('categories/priority', 'CategoryController@priority')->name('categories.priority');
		Route::delete('categories/{id}/remove', 'CategoryController@remove')->name('categories.remove')->where('id','[0-9]+');

		Route::resource('suppliers', 'SupplierController');
		Route::post('suppliers/status', 'SupplierController@status')->name('suppliers.status');
		Route::post('suppliers/priority', 'SupplierController@priority')->name('suppliers.priority');

		Route::resource('attributes', 'AttributeController');
		Route::post('attributes/status', 'AttributeController@status')->name('attributes.status');
		Route::post('attributes/priority', 'AttributeController@priority')->name('attributes.priority');

		Route::resource('products', 'ProductController');


	});
});


Route::get('/home', 'HomeController@index')->name('home');
