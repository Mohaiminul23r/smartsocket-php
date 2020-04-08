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
	Route::resource('types', 'TypeController');
	Route::post('types/updateStatus/{type}', 'TypeController@updateStatus')->name('types.updateStatus');
	Route::resource('ports', 'PortController');
	Route::post('ports/updateStatus/{port}', 'PortController@updateStatus')->name('ports.updateStatus');
	Route::resource('devices', 'DeviceController');
	Route::post('devices/updateStatus/{device}', 'DeviceController@updateStatus')->name('devices.updateStatus');
	Route::resource('roles', 'RoleController');
	Route::get('/role/get-data-json', "RoleController@getDataForDataTable")->name('roles.getDataForDataTable');
	Route::resource('permissions', 'PermissionController');
	Route::get('user/get-role/{id}', 'UserController@getUserRole')->name('user.getRole');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::post('user/updateStatus/{user}', 'UserController@updateStatus')->name('user.updateStatus');
	Route::get('user/view-details/{id}', 'UserController@viewDetails')->name('user.viewDetails');
	Route::post('user/assign-roles/{user}', 'UserController@saveAssignedRole')->name('user.saveAssignedRole');
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

