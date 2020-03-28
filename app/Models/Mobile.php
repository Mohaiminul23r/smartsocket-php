<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mobile extends Model
{
	protected $fillable = [
		'imei',
		'user_id',
		'status',
		'created_by',
		'modified_by'
	];

	protected $guarded = [];

	public function owner()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	public function lives()
	{
		return $this->hasMany('App\Models\Live');
	}
}
