@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
         <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="fas fa-mobile-alt"></i>
              </div>
              <p class="card-category font-weight-bold text-dark">Total Types</p>
              <h3 class="card-title">{{\App\Models\Type::all()->count()}}</h3>
            </div>
            <div class="card-footer">
              {{-- <div class="stats">
                <i class="fas fa-mobile">local_offer</i> Tracked from Github
              </div> --}}
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="fas fa-tasks text-dark"></i>
              </div>
              <p class="card-category font-weight-bold text-dark">Total Ports</p>
              <h3 class="card-title">{{\App\Models\Port::all()->count()}}</h3>
            </div>
            <div class="card-footer">
              {{-- <div class="stats">
                <i class="material-icons">update</i> Just Updated
              </div> --}}
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="fas fa-desktop"></i>
              </div>
              <p class="card-category font-weight-bold text-dark">Total Devices</p>
              <h3 class="card-title">{{\App\Models\Device::all()->count()}}</h3>
            </div>
            <div class="card-footer">
              {{-- <div class="stats">
                <i class="material-icons">local_offer</i> Tracked from Github
              </div> --}}
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="fa fa-users text-dark"></i>
              </div>
              <p class="card-category  font-weight-bold text-dark">Total Users</p>
              <h3 class="card-title">{{\App\User::all()->count()}}</h3>
            </div>
            <div class="card-footer">
              {{-- <div class="stats">
                <i class="material-icons">update</i> Just Updated
              </div> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush