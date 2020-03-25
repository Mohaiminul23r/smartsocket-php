<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id');
            $table->foreignId('mobile_id');
            $table->foreignId('port_id');
            $table->tinyInteger('status')->default(1);
            $table->foreignId('created_by');
            $table->foreignId('modified_by')->nullable();
            $table->timestamps();
        });

        Schema::table('lives', function(Blueprint $table){

            $table->unique(['device_id', 'mobile_id', 'port_id']);

            $table->foreign('device_id')
                  ->references('id')->on('devices');

            $table->foreign('mobile_id')
                  ->references('id')->on('mobiles');

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
        Schema::dropIfExists('lives');
    }
}
