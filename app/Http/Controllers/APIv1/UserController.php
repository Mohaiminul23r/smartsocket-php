<?php

namespace App\Http\Controllers\APIv1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\StoreUser;
use App\Models\Device;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use File as LaraFile;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;

class UserController extends Controller
{
	public function register(StoreUser $request)
	{
		$validated = $request->validated();

		$user = User::create([
			'name'     => $validated['name'],
			'email'    => $validated['email'],
			'password' => Hash::make($validated['password']),
			'phone'    => $validated['phone'],
			'city'     => $validated['city'],
			'country'  => $validated['country']
		]);

		event(new Registered($user));

		return $this->sendJson(201, true, config('rest.response.add.code'), $user, 'success');
	
	}

	public function login(Request $request){

		$validated  = $request->validate([			
			'email'    => 'bail|required|string|email|max:255',
			'password' => 'bail|required|string|min:6',
		]);		

		if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
			$user = Auth::user();
			if($user->status == 0){
				$error = config('rest.response.login.inactive');
				return $this->sendJson(401, false, $error['code'], $error['message'], 'danger');
			}
			$success['accessToken'] = $user->createToken('SmartSocket')->accessToken;
			$success['user'] = $user;
			return $this->sendJson(200, true, config('rest.response.success.code'), $success, 'success');
		} 
		else {
			$error = config('rest.response.login.invalid');
			return $this->sendJson(401, false, $error['code'], $error['message'], 'danger');
		}
	}

	public function profile(Request $request)
	{
		$user = User::find($request->input('user_id'))->first();

		return $this->sendJson(200, true, config('rest.response.success.code'), $user, 'success');
	}

	public function update(User $user, Request $request)
	{
		$validated     = $request->validate([
			'name'     => 'bail|nullable|string|max:255',
			'email'    => ['bail', 
						   'nullable', 
						   'string', 
						   'email', 
						   'max:255', 
						   Rule::unique('users')->ignore($request->user->id)
						],
			'phone'    => 'bail|nullable|string|max:50',
			'city'     => 'bail|nullable|string|max:50',
			'country'  => 'bail|nullable|string|max:50'
		]);

		$user = User::where('id', $user->id)->update([
			'name'     => $validated['name'],
			'email'    => $validated['email'],
			'phone'    => $validated['phone'],
			'city'     => $validated['city'],
			'country'  => $validated['country']
		]);

		return $this->sendJson(206, true, config('rest.response.success.code'), $user, 'success');
	
	}

	public function changePassword(User $user, Request $request)
	{

		$validator = Validator::make($request->all(), [
			'password'        => 'bail|required|string|min:6|confirmed',
			'currentPassword' => 'bail|required|string|min:6',
		]);

		$validated = $validator->after(function($validator) use ($user){

			if(!Hash::check($validator->getData()['currentPassword'], $user->makeVisible('password')->password))
			{
				$validator->errors()->add('currentPassword','Current Password is not matched');
			}
		})->validate();


		$user = User::where('id', $user->id)->update([
			'password' => Hash::make($validated['password'])
		]);

		return $this->sendJson(206, true, config('rest.response.success.code'), $user, 'success');
	
	}

	public function changeProfilePic(User $user, Request $request)
	{

		$fileName = NULL;

		$validated = $request->validate(['image' => 'bail|required|image|max:6000' ]);

		$file = $request->file('image');

		if ($file->isValid()) 
		{
			   
			$fileName = rand(1000, 9999) . time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());                        

			$file->move(public_path('upload/'), $fileName);

			if($user->image)
			{
				unlink(public_path('upload/' . $user->image));
			}

		}

		$user = User::where('id', $user->id)->update(['image' => $fileName ]);

		return $this->sendJson(206, true, config('rest.response.success.code'), $user, 'success');
	
	}

	public function addDevice(Request $request)
	{

		$validatedData = $request->validate([
			'user_id' => 'bail|required|integer|exists:users,id',
			'espId'   => 'bail|required|string|max:100|exists:devices',
		]);

		$user = User::find($validatedData['user_id']);
		$device = Device::where('espId', $validatedData['espId'])->first();

		$user->devices()->attach($device);

		return $this->sendJson(201, true, config('rest.response.add.code'), config('rest.response.add.message'), 'success');
	
	}

	public function removeDevice(Request $request)
	{
		$validatedData =  $request->validate([
			'user_id' => 'bail|required|integer|exists:users,id',
			'espId'   => 'bail|required|string|max:100|exists:devices',
		]);

		$user = User::find($validatedData['user_id']);
		$device = Device::where('espId', $validatedData['espId'])->first();

		$user->devices()->detach($device);

		return $this->sendJson(201, true, config('rest.response.remove.code'), config('rest.response.remove.message'), 'success');
	}
}
