<?php

use Illuminate\Database\Seeder;
use App\Models\Type;
use App\User;

class TypeTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$user = User::where('email','admin@systechdigital.com')->first();
		Type::insert([
			[
				'id' => 1,
				'name' => 'Smart Socket',
				'description' => '',				
				'created_by' => $user->id
			],
			[
				'id' => 2,
				'name' => 'Smart Switch',
				'description' => '',				
				'created_by' => $user->id
			],
		]);
	}
}
