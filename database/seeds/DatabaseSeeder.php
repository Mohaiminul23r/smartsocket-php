<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call('UserTableSeeder');
    	$this->call('TypeTableSeeder');
        $this->call('PortTableSeeder');
        $this->call('DeviceTableSeeder');        
        $this->call('PermissionTableSeeder');
    }
}
