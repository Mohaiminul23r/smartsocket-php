<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
	protected $fillable = [
		'espId',
		'type_id',
		'name',
		'description',
		'created_by',
		'modified_by'
	];

	protected $guarded = [];

	public function type()
	{
		return $this->belongsTo('App\Models\Type');
	}

	public function owners()
	{
		return $this->belongsToMany('App\User');
	}

	public function ports()
	{
		return $this->belongsToMany('App\Models\Port');
	}

	public function lives()
	{
		return $this->hasMany('App\Models\Live');
	}
}
