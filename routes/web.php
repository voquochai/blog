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
	Route::get('/', 'DashboardController@index')->name('dashboard');
	Route::resources([
		'users' => 'UserController',
	]);

	Route::post('users/changeStatus', 'UserController@changeStatus')->name('users.change_status');
	Route::post('users/updatePriority', 'UserController@updatePriority')->name('users.update_priority');

});