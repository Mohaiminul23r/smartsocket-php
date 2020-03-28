<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name'     => 'bail|required|string|max:255',
			'email'    => 'bail|required|string|email|max:255|unique:users',
			'password' => 'bail|required|string|min:6|confirmed',
			'phone'    => 'bail|nullable|string|max:50',
			'city'     => 'bail|required|string|max:50',
			'country'  => 'bail|required|string|max:50'
		];
	}
}
