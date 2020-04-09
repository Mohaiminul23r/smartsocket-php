@extends('layouts.app', ['activePage' => 'Warning', 'titlePage' => __('Warning Message')])
@section('content')
<div class="content p-2">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-warning" role="alert">
		 <strong>Permission Denied !!</strong>
		</div>
      </div>
    </div>
  </div>
</div>
@endsection