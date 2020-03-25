<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_user', function (Blueprint $table) {
            $table->foreignId('device_id');
            $table->foreignId('user_id');
        });

        Schema::table('device_user', function(Blueprint $table){

            $table->foreign('device_id')
                  ->references('id')->on('devices');

            $table->foreign('user_id')
                        ->references('id')->on('users');

            $table->unique(['device_id', 'user_id']);

        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_user');
    }
}
