<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnAtDevicePortTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('device_port', function (Blueprint $table) {
            $table->dropForeign(['device_id']);
            $table->foreign('device_id')
                  ->references('id')->on('devices')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('device_port', function (Blueprint $table) {
            $table->dropForeign('device_id');
            $table->foreign('device_id')
                  ->references('id')->on('devices');
        });
    }
}
