<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
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
