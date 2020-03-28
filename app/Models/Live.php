<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Live extends Model
{
	protected $fillable = [
		'device_id',
		'mobile_id',
		'port_id',
		'status',
		'created_by',
		'modified_by'
	];

	protected $guarded = [];

	public function device()
	{
		return $this->belongsTo('App\Models\Device');
	}

	public function mobile()
	{
		return $this->belongsTo('App\Models\Mobile');
	}

	public function port()
	{
		return $this->belongsTo('App\Models\Port');
	}
}
