<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->namespace('APIv1')->group(function () {	

	Route::post('register', 'UserController@register');
	Route::post('login', 'UserController@login');
	
	Route::middleware(['auth:api','verified'])->group(function () {

		Route::get('user', function (Request $request) {
		    return App\User::all();
		});

		Route::get('profile', 'UserController@profile')->name('profile');
		Route::put('profile-update/{user}', 'UserController@update')->name('profileUpdate');
		Route::put('change-password/{user}', 'UserController@changePassword')->name('changePassword');
		Route::put('change-profile-pic/{user}', 'UserController@changeProfilePic')->name('changeProfilePic');
		Route::post('user-device-add', 'UserController@addDevice')->name('addDevice');
		Route::delete('user-device-remove', 'UserController@removeDevice')->name('removeDevice');
		Route::post('device-state', 'DeviceController@updateState')->name('updateState');
		Route::get('device-state', 'DeviceController@state')->name('state');
	});
});