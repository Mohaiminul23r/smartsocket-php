<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use CommonTrait;
    protected $table = 'types';
    protected $fillable = [
		'name',
		'description',
		'created_by',
		'modified_by'
	];

	protected $hidden = ['pivot'];
	
	protected $guarded = [];

	public function devices()
	{
		return $this->hasMany('App\Models\Device');
	}
}
