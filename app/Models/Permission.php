<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name','description','module'];

    public function role() {
        return $this->hasMany('App\Role');
    }
}
