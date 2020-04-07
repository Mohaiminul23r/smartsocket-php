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
    	// $this->call('RolesTableSeeder');
     //    $this->call('PermissionsTableSeeder');
     //    $this->call('ConnectRelationshipsSeeder');
        $this->call([UserTableSeeder::class]);
    }
}
