<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DevicePort extends Model
{
    protected $table = 'device_port';
	protected $fillable = ['device_id','port_id'];
	public $timestamps = false;
}
