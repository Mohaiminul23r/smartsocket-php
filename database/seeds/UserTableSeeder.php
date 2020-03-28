<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name' => 'SDL Admin',
			'email' => 'admin@systechdigital.com',
			'email_verified_at' => now(),
			'password' => Hash::make('secret'),
			'phone' => '123456789',
			'city' => 'Dhaka',
			'country' => 'Bangladesh',
			'created_at' => now(),
			'updated_at' => now()
        ]);
    }
}
