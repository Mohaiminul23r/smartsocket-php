<?php

use Illuminate\Database\Seeder;
use App\Models\Device;
use App\User;

class DeviceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email','admin@systechdigital.com')->first();
        $device = Device::create(
			[
				'espId' => 'SDLESP20200101',
				'type_id' => 1,
				'name' => 'Default Device',
				'description' => '',				
				'created_by' => $user->id
			]
		);

        $device->ports()->attach([1,2,3]);
    }
}
