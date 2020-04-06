<?php

namespace App\Http\Controllers\APIv1;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Mobile;
use App\Models\Port;
use App\Models\Live;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
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
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Device  $device
	 * @return \Illuminate\Http\Response
	 */
	public function show(Device $device)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Device  $device
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Device $device)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Device  $device
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Device $device)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Device  $device
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Device $device)
	{
		//
	}

	public function updateState(Request $request)
	{
		$validatedData =  $request->validate([
			'espId'   => 'bail|required|string|max:100|exists:devices',
			'uuid'    => 'bail|required|string|max:50|exists:mobiles',
			'port'    => 'bail|required|string|max:50|exists:ports,name',
			'status'  => 'bail|required|boolean'
		]);

		$device = Device::where('espId', $validatedData['espId'])->first();

		$mobile = Mobile::where('uuid', $validatedData['uuid'])->first();

		$port = Port::where('name', $validatedData['port'])->first();

		$live = Live::where(['device_id' => $device->id, 'mobile_id' => $mobile->id, 'port_id' => $port->id])->first();

		if($live)
		{
			Live::where(['device_id' => $device->id])
				->where(['port_id'   => $port->id])
				->update(['status'   => 0], ['modified_by' => 1]); // replace 1 by $request->user()->id

			if($validatedData['status'])
			{
				$live->status = $validatedData['status'];
				$live->modified_by = 1; // replace 1 by $request->user()->id
				$live->save();
			}

		} else{

			Live::create([
						  'device_id'  => $device->id, 
						  'mobile_id'  => $mobile->id, 
						  'port_id'    => $port->id,
						  'status'     => $validatedData['status'],
						  'created_by' =>  1 // replace 1 by $request->user()->id
						]);
		}

		return $this->sendJson(201, true, config('rest.response.status.code'), config('rest.response.status.message'), 'success');
   
	}

	public function state(Request $request)
	{
		
		$validatedData =  $request->validate([
			'espId'   => 'bail|required|string|max:100|exists:devices'
		]);

		$device = Device::where('espId', $validatedData['espId'])->first();

		$states = Live::where('device_id', $device->id)
						->where('status', 1)
						->orderBy('port_id')
						->with('port')
						->get()
						->toArray();

		$allPorts = [];

		foreach($device->ports->toArray() as $key => $port)
		{
			$allPorts[$port['name']] = 0;
		}

		$onPorts = [];

		foreach($states as $state)
		{
			$onPorts[$state['port']['name']] = 1;
		}

		return $this->sendJson(200, true, config('rest.response.success.code'), array_replace($allPorts, $onPorts), 'success');
	}


}
