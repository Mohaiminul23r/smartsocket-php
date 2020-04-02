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

    public function GetDataForDataTable()
    {
        $where = $this->Where;
        $offset = $this->Offset;
        $limit = $this->Limit;
        $join = $this->Join;
        $search = $this->Search;
        $order_by = $this->Order;

        $totalData = $this::query();
        $filterData = $this::query();
        $totalCount = $this::query();

        if (count($where) > 0) {
            foreach ($where as $keyW => $valueW) {
                if (strpos($keyW, ' IN') !== false) {
                    $keyW = str_replace(' IN', '', $keyW);
                    $totalData->whereIn($keyW, $valueW);
                    $filterData->whereIn($keyW, $valueW);
                    $totalCount->whereIn($keyW, $valueW);
                } else if (strpos($keyW, ' NOTIN') !== false) {
                    $keyW = str_replace(' NOTIN', '', $keyW);
                    $totalData->whereNotIn($keyW, $valueW);
                    $filterData->whereNotIn($keyW, $valueW);
                    $totalCount->whereNotIn($keyW, $valueW);
                } else if (is_array($valueW)) {
                    $totalData->where([$valueW]);
                    $filterData->where([$valueW]);
                    $totalCount->where([$valueW]);
                } else if (strpos($keyW, ' and') === false) {
                    $totalData->orWhere($keyW, $valueW);
                    $filterData->orWhere($keyW, $valueW);
                    $totalCount->orWhere($keyW, $valueW);
                } else {
                    $keyW = str_replace(' and', '', $keyW);
                    $totalData->where($keyW, $valueW);
                    $filterData->where($keyW, $valueW);
                    $totalCount->where($keyW, $valueW);
                }
            }
        }

        if ($limit > 0) {
            $totalData->limit($limit)->offset($offset);
        }

        
        $totalData->leftJoin('users', 'ports.created_by', '=', 'users.id');
        $filterData->leftJoin('users', 'ports.created_by', '=', 'users.id');
        $totalCount->leftJoin('users', 'ports.created_by', '=', 'users.id');
        


        if (count($search) > 0) {
            $totalData->where(function ($totalData) use ($search) {
                foreach ($search as $keyS => $valueS) {
                    if (strpos($keyS, ' and') === false) {
                        $totalData->orWhere($keyS, 'like', "%$valueS%");
                    } else {
                        $keyS = str_replace(' and', '', $keyS);
                        $totalData->where($keyS, $valueS);
                    }
                }
            });

            $filterData->where(function ($filterData) use ($search) {
                foreach ($search as $keyS => $valueS) {
                    $filterData->orWhere($keyS, 'like', "%$valueS%");
                }
            });
        }

        if (count($order_by) > 0) {
            foreach ($order_by as $col => $by) {
                $totalData->orderBy($col, $by);
            }
        } else {
            $totalData->orderBy($this->getTable() . '.id', 'DESC');
        }


        $totalData = $totalData->selectRaw('ports.id, ports.name as portName, users.name as userName, ports.description, ports.status')->get();
        $totalData->transform(function ($item) {
            $item['Row_Index'] = ++$this->offset;
            return $item;
        });


        return [
            'data' => $totalData,
            'draw' => 0,
            'recordsTotal' => $totalCount->count(),
            'recordsFiltered' => $filterData->count(),
        ];
    }
}
