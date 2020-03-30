<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{

    protected $table = 'types';
   

	use CommonTrait;

	protected $fillable = [
		'name',
		'description',
		'created_by',
		'modified_by'
	];
	
	protected $guarded = [];

	public function devices()
	{
		return $this->hasMany('App\Models\Device');
	}
}
