<?php

use Illuminate\Database\Seeder;
use App\Models\Port;
use App\User;

class PortTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$user = User::where('email','admin@systechdigital.com')->first();
		Port::insert([
			[
				'id' => 1,
				'name' => 'USB Port',
				'description' => '',
				'created_by' => $user->id
			],
			[
				'id' => 2,
				'name' => 'AC Port',
				'description' => '',				
				'created_by' => $user->id
			],
		]);
	}
}
