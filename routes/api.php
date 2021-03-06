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
	
	Route::get('device-state', 'DeviceController@state')->name('state');
	Route::post('forget-password', 'UserController@sendPasswordLink')->name('forgetPassword');

	Route::middleware('SDLCrypt')->group(function(){
		
		Route::post('register', 'UserController@register');
		Route::post('login', 'UserController@login');

		Route::middleware(['auth:api','verified'])->group(function () {

			Route::get('user', function (Request $request) {
			    return App\User::all();
			});

			Route::get('profile', 'UserController@profile')->name('profile');
			Route::put('profile-update', 'UserController@update')->name('profileUpdate');
			Route::put('change-password', 'UserController@changePassword')->name('changePassword');
			Route::put('change-profile-pic', 'UserController@changeProfilePic')->name('changeProfilePic');
			Route::get('user-device', 'UserController@getDevice')->name('getDevice');
			Route::post('user-device', 'UserController@addDevice')->name('addDevice');
			Route::delete('user-device/{espId}', 'UserController@removeDevice')->name('removeDevice');
			Route::get('user-mobile', 'UserController@getMobile')->name('getMobile');
			Route::post('user-mobile', 'UserController@addMobile')->name('addMobile');
			Route::delete('user-mobile/{uuid}', 'UserController@removeMobile')->name('removeMobile');
			Route::put('device-state', 'DeviceController@updateState')->name('updateState');
		});
	});	

	if(env('APP_ENV') == 'local'){
	Route::get('SDLCrypt',function(Request $request){
		return SDLCrypt::encrypt("Hello World",env('SDLCrypt_KEY'));
	});

	Route::post('SDLCrypt',function(Request $request){		
		return SDLCrypt::encrypt($request->text,env('SDLCrypt_KEY'));
	});

	Route::put('SDLCrypt',function(Request $request){		
		return SDLCrypt::decrypt($request->text,env('SDLCrypt_KEY'));
	});
	}

});