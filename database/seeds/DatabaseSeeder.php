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
    	$this->call('TypeTableSeeder');
        $this->call('PortTableSeeder');
        $this->call('PermissionTableSeeder');
        $this->call('UserTableSeeder');
        $this->call('DeviceTableSeeder');        
    }
}
