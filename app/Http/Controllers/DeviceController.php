<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Type;
use Auth;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()){
            $device = new Device();
            return $device->DataTableLoader($request);
        }
        $types = Type::all();
        return view('devices.index',compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Device $device)
    {
        //dd($request->all());
        $request->validate([
            'espId' => 'required',
            'type_id' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);
        $postData = $request->all();
        $postData['created_by'] = Auth::id();
        Device::create($postData);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Device $device)
    {
        return $device;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Device $device)
    {
        $request->validate([
            'espId' => 'required',
            'type_id' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);
        $updateData = $request->all();
        $updateData['modified_by'] = Auth::id();
        $device->update($updateData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device)
    {
        $device->delete();
    }

    public function updateStatus(Request $request, Device $device){
        if($request->status != NULL){
            $device->status = $request->status;
        }
        return (($device->update()) ? 1 : 0);
    }
}
