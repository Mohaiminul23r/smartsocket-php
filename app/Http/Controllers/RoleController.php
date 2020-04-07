<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $result = Permission::orderBy('module','ASC')->get();
        $permissions = [];

        foreach ($result as $key => $item) {
            $permissions[$item->module][$key] = $item;
        }
        
        array_multisort($permissions,SORT_DESC);
        return view('roles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, ['name' => 'required|unique:roles',
                                     'description'=>'required']);
        $data = $request->only('name','description');
        $role = new Role;
        $role = Role::create($data);
        $role->Permissions()->sync($request->permission);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $role_permission = $role->permissions->pluck('id')->all();
        $result = Permission::all();
        $permissions = [];
        foreach ($result as $key => $item) {
            $permissions[$item->module][$key] = $item;
        }
        
        array_multisort($permissions,SORT_DESC);

        return view('roles.edit',compact('role','permissions','role_permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $data = $request->only('name','description');
        $role->update($data);
        $role->Permissions()->sync($request->permission);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
    }

    public function GetDataForDataTable(Request $request) {
        $role = new role();
        return $role->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }
}
