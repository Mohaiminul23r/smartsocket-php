@extends('layouts.app', ['activePage' => 'ports.index', 'titlePage' => __('Manage Ports')])
@section('content')
<div class="content p-2">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary p-2">
            <h5 class="card-title font-weight-bold">Add/Edit Ports</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
              
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary p-2">
            <h5 class="card-title mt-0 font-weight-bold">List of all Ports</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
               
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection