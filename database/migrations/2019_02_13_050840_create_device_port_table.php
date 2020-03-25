<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicePortTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_port', function (Blueprint $table) {
            $table->foreignId('device_id');
            $table->foreignId('port_id');
        });

        Schema::table('device_port', function(Blueprint $table) {

            $table->foreign('device_id')
                  ->references('id')->on('devices');

            $table->foreign('port_id')
                  ->references('id')->on('ports');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_port');
    }
}
