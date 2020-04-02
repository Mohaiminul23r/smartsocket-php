@extends('layouts.app', ['activePage' => 'Types', 'titlePage' => __('Types')])
@section('content')
<div class="content p-2">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary p-2">
            <h6 class="card-title">User Details</h6>
          </div>
          <div class="card-body">
          	<div class="container border">
          		<div class="row">
			  <div class="col-md-4" style="text-align: right;">
			    <img src="{{asset('image/Headshot-Placeholder-1.png')}}" alt="Profile Picture" class="w-50 img-thumbnail mt-4">
			  </div>
			  <div class="col-md-8">
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
                   </tbody>
                </table>
			  </div>
			</div>
          	</div>
        	 <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">
                    <tr><th>
                        Name
                    </th>
                    <th>
                      Email
                    </th>
                    <th>
                      Creation date
                    </th>
                    <th class="text-right">
                      Actions
                    </th>
                  </tr></thead>
                  <tbody>
                                            <tr>
                        <td>
                          Admin Admin
                        </td>
                        <td>
                          admin@material.com
                        </td>
                        <td>
                          2020-02-24
                        </td>
                        <td class="td-actions text-right">
                             <a rel="tooltip" class="btn btn-success btn-link" href="#" data-original-title="" title="">
                              <i class="material-icons">edit</i>
                              <div class="ripple-container"></div>
                            </a>
                                                    </td>
                      </tr>
                                        </tbody>
                </table>
              </div>
          </div>
        </div>
      </div>
{{--       <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary p-2">
            <h6 class="card-title mt-0">List of all Types</h6>
          </div>
          <div class="card-body">
            <div class="container border">
                <div class="table-responsive">
                    
                </div> 
            </div>
          </div>
        </div>
      </div> --}}
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