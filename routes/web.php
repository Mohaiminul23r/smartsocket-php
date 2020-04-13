<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('/warning', 'HomeController@warning')->name('homes.warning');
	//for user routes
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::post('user/updateStatus/{user}', 'UserController@updateStatus')->name('user.updateStatus');
	Route::get('user/view-details/{id}', 'UserController@viewDetails')->name('user.viewDetails');
	Route::get('user/edit/{id}', 'UserController@edit')->name('user.edit');
	Route::put('user', ['as' => 'user.update', 'uses' => 'UserController@update']);
	Route::post('user/assign-roles/{user}', 'UserController@saveAssignedRole')->name('user.saveAssignedRole');
	Route::get('user/get-role/{id}', 'UserController@getUserRole')->name('user.getRole');
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

	//for type routes
	Route::resource('types', 'TypeController');
	Route::post('types/updateStatus/{type}', 'TypeController@updateStatus')->name('types.updateStatus');

	//for port routes
	Route::resource('ports', 'PortController');
	Route::post('ports/updateStatus/{port}', 'PortController@updateStatus')->name('ports.updateStatus');

	//for device routes
	Route::resource('devices', 'DeviceController');
	Route::post('devices/updateStatus/{device}', 'DeviceController@updateStatus')->name('devices.updateStatus');

	//for role routes
	Route::resource('roles', 'RoleController');
	Route::get('/role/get-data-json', "RoleController@getDataForDataTable")->name('roles.getDataForDataTable');

	//for permission routes
	//Route::resource('permissions', 'PermissionController');
});

