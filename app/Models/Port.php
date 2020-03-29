<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
    use CommonTrait;
    protected $table = 'ports';
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
        return $this->belongsToMany('App\Models\Device');
    }

    public function lives()
    {
        return $this->hasMany('App\Models\Live');
    }
}
