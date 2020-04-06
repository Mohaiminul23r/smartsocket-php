<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceUser extends Model
{
    protected $table = 'device_user';
	protected $fillable = ['device_id','user_id'];
	public $timestamps = false;
}
