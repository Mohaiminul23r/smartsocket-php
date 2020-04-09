@extends('layouts.app', ['activePage' => 'Warning', 'titlePage' => __('Warning Message')])
@section('content')
<div class="content p-2">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 offset-2">
        <div class="alert text-center" role="alert">
		 <strong>Permission Denied !!</strong>
		</div>
      </div>
    </div>
  </div>
</div>
@endsection