@extends('layouts.app', ['activePage' => 'Users', 'titlePage' => __('User Details')])
@section('content')
<div class="content p-2">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary p-2">
            <h5 class="card-title">User Details</h5>
          </div>
          <div class="card-body">
          	<div class="container border">
          		<div class="row">
			  <div class="col-md-4" style="text-align: right;">
			  	@if($user_data->image == null || file_exists($user_data->image) == false)
			    	<img src="{{asset('image/Headshot-Placeholder-1.png')}}" alt="Profile Picture" class="w-50 img-thumbnail mt-5">
			    @elseif(($user_data->image != null && file_exists($user_data->image) == true))
			    	<img src="{{url($user_data->image)}}" alt="Profile Picture" class="w-50 img-thumbnail mt-5">
			    @endif
			  </div>
			  <div class="col-md-8">
			  	<a type="button" href="{{route('user.index')}}" style="font-size:14px;" class="btn btn-sm btn-outline pr-4 pl-4 pull-right mr-2 text-capitalize mt-2 mb-2 btn-link">{{ __(' Go Back') }}</a>
			   	<table class="table table-striped mt-2 table-bordered" width="100%">
                  <tbody>
                    <tr>
                       <th width="20%" class="border-0 p-1 pl-2">User Name:</th>
                       <td width="80%" class="border-0 p-1">{{$user_data->name}}</td>
                    </tr>
                    <tr>
                       <th width="20%" class="border-0 p-1 pl-2">Email:</th>
                       <td width="80%" class="border-0 p-1">{{$user_data->email}}</td>
                    </tr>
                    <tr>
                       <th width="20%" class="border-0 p-1 pl-2">Contact No:</th>
                       <td width="80%" class="border-0 p-1">{{$user_data->phone}}</td>
                    </tr>
                    <tr>
                       <th width="20%" class="border-0 p-1 pl-2">From:</th>
                       <td width="80%" class="border-0 p-1">{{$user_data->city}}, {{$user_data->country}}</td>
                    </tr>
                    <tr>
                       <th width="20%" class="border-0 p-1 pl-2">Created At:</th>
                       <td width="80%" class="border-0 p-1">{{$user_data->created_at}}</td>
                    </tr>
                    <tr>
                       <th width="20%" class="border-0 p-1 pl-2">Status:</th>
                       <td width="80%" class="border-0 p-1">
                       	@if($user_data->status == 0)
                       		<span class="badge badge-danger">Inctive User</span>
                       	@elseif($user_data->status == 1)
                       		<span class="badge badge-success">Active User</span>
                       	@endif
                       </td>
                    </tr>
                    <tr>
                       <th width="20%" class="border-0 p-1 pl-2">Assigned Role:</th>
                       <td width="80%" class="border-0 p-1">
                       	@if($user_data->roles->isEmpty() != true)
	                       	@foreach($user_data->roles as $role)
	                       		<span class="badge badge-info">{{$role->name}}</span><span class="pl-2 font-weight-bold">{{$role->description}}</span>
	                       	@endforeach
                       	@elseif($user_data->roles->isEmpty() == true)
                       		<span class="pl-2 font-weight-bold text-warning">Role not Assigned</span>
                       	@endif
                       </td>
                    </tr>
                   </tbody>
                </table>
			  </div>
			</div>
          	</div>
              <div class="accordion" id="accordionExample">
				  <div class="card border" style="background: aliceblue;">
				    <div class="card-header p-0" id="headingOne">
				      <h2 class="mb-0">
				        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
				          <span style="color:black;font-size: 15px;" class="text-capitalize font-weight-bold font-italic">Show Device Details...</span>
				        </button>
				      </h2>
				    </div>
				    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
				      <div class="card-body">
		                <table class="table table-striped table-bordered table-active" width="100%">
			                 <thead>
			                 	<tr>
			                   		<th width="100%" colspan="6" class="border-success pt-2 pb-2 font-weight-bold" style="font-size:16px; text-align:center;    color: teal;">List of the Available Devices of {{$user_data->name}}</th>
			                 	</tr>
			                   	<tr>
			                   		<th width="8%" class="pt-1 pb-1 font-weight-bold" style="font-size:15px;">SL</th>
			                   		<th width="15%" class="pt-1 pb-1 font-weight-bold" style="font-size:15px;">Device Id</th>
			                   		<th width="20%" class="pt-1 pb-1 font-weight-bold" style="font-size:15px;">Name</th>
			                   		<th width="14%" class="pt-1 pb-1 font-weight-bold" style="font-size:15px;">Device Type</th>
			                   		<th width="13%" class="pt-1 pb-1 font-weight-bold" style="font-size:15px;">Port</th>
			                   		<th width="25%" class="pt-1 pb-1 font-weight-bold" style="font-size:15px;">Description</th>
			                  	</tr>
			              	</thead>
			                 <tbody>
			                 	@if($device_data->devices->isEmpty() != true)
				                 	@php
				                 		$i = 1;
				                 	@endphp
				                 	@foreach($device_data->devices as $device)
				                 		<tr>
				                 			<td class="pt-1 pb-1">
				                 				@php
				                 					echo $i;
				                 				@endphp
				                 			</td>
				                 			<td class="pt-1 pb-1">{{$device->espId}}</td>
				                 			<td class="pt-1 pb-1">{{$device->name}}</td>
				                 			<td class="pt-1 pb-1">{{$device->type->name}}</td>
				                 			<td class="pt-1 pb-1">
				                 				@foreach($device->ports as $port)
				                 				<span class="badge badge-warning">{{$port->name}}</span>
				                 				@endforeach
				                 			</td>
				                 			<td class="pt-1 pb-1">{{strip_tags($device->description)}}</td>
				                 		</tr>
				                 		@php
				                 			$i++;
				                 		@endphp
				                 	@endforeach
			                 	@elseif($device_data->devices->isEmpty() == true)
			                 		<tr>
			                 			<td class="pt-1 pb-1 text-center" colspan="6">No device availabe for this User.</td>
			                 		</tr>
			                 	@endif
			                 </tbody>
		                </table>
				      </div>
				    </div>
				  </div>
				  <div class="card border" style="background: aliceblue;">
				    <div class="card-header p-0" id="headingTwo">
				      <h2 class="mb-0">
				        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
				         <span style="color:black;font-size: 15px;" class="text-capitalize font-weight-bold font-italic">Show Available Mobile Devices...</span>
				        </button>
				      </h2>
				    </div>
				    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
				      <div class="card-body">
				       	<table class="table table-striped table-bordered table-active" width="100%">
			                 <thead>
			                 	<tr>
			                   		<th width="100%" colspan="6" class="border-info pt-2 pb-2 font-weight-bold" style="font-size:16px; text-align:center;    color: darkslateblue;">List of the Available Mobiles of {{$user_data->name}}</th>
			                 	</tr>
			                   	<tr>
			                   		<th width="15%" class="pt-1 pb-1 font-weight-bold" style="font-size:15px;">SL</th>
			                   		<th width="30%" class="pt-1 pb-1 font-weight-bold" style="font-size:15px;">UUID</th>
			                   		<th width="35%" class="pt-1 pb-1 font-weight-bold" style="font-size:15px;">User Name</th>
			                   		<th width="20%" class="pt-1 pb-1 font-weight-bold" style="font-size:15px;">Status</th>
			                  	</tr>
			              	</thead>
			                 <tbody>
			                 	@if($device_data->mobiles->isEmpty() != true)
				                 	@php
				                 		$i = 1;
				                 	@endphp
				                 	@foreach($user_data->mobiles as $mobile)
				                 		<tr>
				                 			<td class="pt-1 pb-1">
				                 				@php
				                 					echo $i;
				                 				@endphp
				                 			</td>
				                 			<td class="pt-1 pb-1">{{$mobile->uuid}}</td>
				                 			<td class="pt-1 pb-1">{{$user_data->name}}</td>
				                 			<td class="pt-1 pb-1">
				                 				@if($mobile->status == 1)
				                 				<span class="badge badge-success">Active</span>
				                 				@elseif($mobile->status == 0)
				                 				<span class="badge badge-danger">Not Active</span>
				                 				@endif
				                 			</td>
				                 		</tr>
				                 		@php
				                 			$i++;
				                 		@endphp
				                 	@endforeach
			                 	@elseif($device_data->mobiles->isEmpty() == true)
			                 		<tr>
			                 			<td class="pt-1 pb-1 text-center" colspan="6">No Mobile device is availabe for this User.</td>
			                 		</tr>
			                 	@endif
			                 </tbody>
		                </table>
				      </div>
				    </div>
				  </div>
				</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')
<script type="text/javascript">
$(document).ready(function(){
    
});
</script>
@endpush