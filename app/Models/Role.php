<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name','description'];

    public function permissions() {
        return $this->belongsToMany('App\Models\Permission');
    }

    public function countRow() {
        $totalData = $this::query();
        return $totalData->select('*')->count();
    }

    public function GetListForDataTable($limit = 20, $offset = 0, $search = "", $status = 0){
        $totalData = $this::query();
        $filterData = $this::query();

        if ($status == 1){
            $totalData->where('where', 1);
            $filterData->where('where', 1);
        }

        if ($limit == -1)
            $limit = 999999;

        return [
            'data'   =>   $totalData->where('name', 'like', '%'.$search.'%')
                  ->orwhere('description', 'like', '%'.$search.'%')
                ->offset($offset)
                ->limit($limit)
                ->latest()
                ->get(),
            'recordsTotal' => $this->countRow(),
            'recordsFiltered' => $filterData->where('name', 'like', '%'.$search.'%')
                ->count(),
            'draw' => 0
        ];

    }
}
