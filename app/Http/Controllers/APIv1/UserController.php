<?php

namespace App\Http\Controllers\APIv1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\StoreUser;
use App\Models\Device;
use App\Models\Mobile;
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
			else if($user->email_verified_at == null){
				$error = config('rest.response.login.not_verified');
				return $this->sendJson(403, false, $error['code'], $error['message'], 'danger');
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
		return $this->sendJson(200, true, config('rest.response.success.code'), $request->user(), 'success');
	}

	public function update(Request $request)
	{
		$validated     = $request->validate([
			'name'     => 'bail|required|string|max:255',
			'email'    => ['bail', 
						   'required', 
						   'string', 
						   'email', 
						   'max:255', 
						   Rule::unique('users')->ignore($request->user()->id)
						],
			'phone'    => 'bail|nullable|string|max:50',
			'city'     => 'bail|required|string|max:50',
			'country'  => 'bail|required|string|max:50'
		]);

		$user = User::where('id', $request->user()->id)->update([
			'name'     => $validated['name'],
			'email'    => $validated['email'],
			'phone'    => $validated['phone'],
			'city'     => $validated['city'],
			'country'  => $validated['country']
		]);

		return $this->sendJson(206, true, config('rest.response.success.code'), $user, 'success');
	
	}

	public function changePassword(Request $request)
	{
		$user = $request->user();
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

	public function changeProfilePic(Request $request)
	{
		$user = $request->user();
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
		$validator = Validator::make($request->all(), [
			'espId'   => 'bail|required|string|max:100|exists:devices',
		]);

		$user = $request->user();
		$device = Device::where('espId', $request->espId)->first();
		$validatedData = $validator->after(function($validator) use ($user, $device){			
			if($user->devices->contains($device->id))
			{
				$validator->errors()->add('espId','Already Added!');
			}
		})->validate();

		$user->devices()->attach($device);

		return $this->sendJson(201, true, config('rest.response.add.code'), config('rest.response.add.message'), 'success');
	
	}

	public function getDevice(Request $request)
	{		
		$user = $request->user();
		$devices = $user->devices()->with('type','ports')->get();

		return $this->sendJson(200, true, config('rest.response.success.code'), $devices, 'success');
	
	}

	public function removeDevice(Request $request, $espId)
	{
		$validator = Validator::make(['espId' => $espId], [
			'espId'   => 'bail|required|string|max:100|exists:devices',
		]);

		$validatedData = $validator->validate();		

		$user = $request->user();
		$device = Device::where('espId', $validatedData['espId'])->first();

		$user->devices()->detach($device);

		return $this->sendJson(201, true, config('rest.response.remove.code'), config('rest.response.remove.message'), 'success');
	}

	public function addMobile(Request $request)
	{		
		$validatedData = $request->validate([			
			'uuid'    => 'bail|required|string|max:50|unique:mobiles',
		]);

		$user = $request->user();
		$mobile = Mobile::create([
			'user_id' => $request->user()->id, 
			'uuid' => $validatedData['uuid'], 
			'status' => 1,
			'created_by' => $request->user()->id
		]);	

		return $this->sendJson(201, true, config('rest.response.add.code'), $mobile, 'success');
	
	}

	public function getMobile(Request $request)
	{
		$user = $request->user();
		$mobiles = $user->mobiles;

		return $this->sendJson(200, true, config('rest.response.success.code'), $mobiles, 'success');
	
	}

	public function removeMobile(Request $request, $uuid)
	{
		$validator = Validator::make(['uuid' => $uuid], [
			'uuid'    => 'bail|required|string|max:50|exists:mobiles',
		]);

		$validatedData = $validator->validate();

		$user = $request->user();
		$device = Mobile::where('uuid', $validatedData['uuid'])->first();

		$device->delete();

		return $this->sendJson(201, true, config('rest.response.remove.code'), config('rest.response.remove.message'), 'success');
	}
}
