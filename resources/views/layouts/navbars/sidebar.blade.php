<div class="sidebar" data-color="green" data-background-color="white" data-image="{{ asset('material/img/sidebar-1.jpg') }}">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="" class="simple-text logo-normal">
      {{ __('Smart Socket') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="fas fa-dashboard"></i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'Types' || $activePage == 'Ports' || $activePage == 'Devices') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#generalSettings" aria-expanded="true">
            <i class="fas fa-cogs"></i>
          <p>{{ __('General Settings') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse{{($activePage=='Types' || $activePage=='Ports' || $activePage=='Devices')?'show':'' }}" id="generalSettings">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'Types' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('types.index') }}">
                <span class="sidebar-mini"><i class="fas fa-bezier-curve"></i></span>
                <span class="sidebar-normal">{{ __('Manage Types') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'Ports' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('ports.index') }}">
                <span class="sidebar-mini"><i class="fas fa-waveform-path"></i></span>
                <span class="sidebar-normal"> {{ __('Manage Ports') }} </span>
              </a>
            </li>
             <li class="nav-item{{ $activePage == 'Devices' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('devices.index') }}">
                <span class="sidebar-mini"><i class="fas fa-game-console-handheld"></i></span>
                <span class="sidebar-normal"> {{ __('Manage Devices') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'Users' || $activePage == 'Roles') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#userManagement" aria-expanded="true">
          <i class="fas fa-user-cog"></i>
          <p>{{ __('User Management') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse{{($activePage=='Profile' || $activePage=='Users' || $activePage=='Roles')?'show':'' }}" id="userManagement">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'Profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"><i class="fas fa-user-edit"></i></span>
                <span class="sidebar-normal">{{ __('User profile') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'Users' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <span class="sidebar-mini"><i class="fas fa-users-class"></i></span>
                <span class="sidebar-normal"> {{ __('User List') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'Roles' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('roles.index') }}">
                <span class="sidebar-mini"><i class="fas fa-user-lock"></i></span>
                <span class="sidebar-normal"> {{ __('Manage Role') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
   {{--    @permission('ports.index')
      <li class="nav-item">
        <a class="nav-link" href="">
          <i class="material-icons">Logout</i>
            <p>{{ __('Logout') }}</p>
        </a>
      </li>
      @endpermission --}}
    </ul>
  </div>
</div>