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
				'name' => 'USB_Port_1',
				'description' => '',
				'created_by' => $user->id
			],
			[
				'id' => 2,
				'name' => 'USB_Port_2',
				'description' => '',				
				'created_by' => $user->id
			],
			[
				'id' => 3,
				'name' => 'AC_Port_1',
				'description' => '',				
				'created_by' => $user->id
			],
		]);
	}
}
