<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material/img/sidebar-1.jpg') }}">
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
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#userManagement" aria-expanded="true">
          <i class="fas fa-user-cog"></i>
          <p>{{ __('User Management') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="userManagement">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"><i class="fas fa-user-edit"></i></span>
                <span class="sidebar-normal">{{ __('User profile') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <span class="sidebar-mini"><i class="fas fa-game-console-handheld"></i></span>
                <span class="sidebar-normal"> {{ __('User List') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      {{-- <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('table') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('Table List') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'typography' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('typography') }}">
          <i class="material-icons">library_books</i>
            <p>{{ __('Typography') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'icons' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('icons') }}">
          <i class="material-icons">bubble_chart</i>
          <p>{{ __('Icons') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'map' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('map') }}">
          <i class="material-icons">location_ons</i>
            <p>{{ __('Maps') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'notifications' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('notifications') }}">
          <i class="material-icons">notifications</i>
          <p>{{ __('Notifications') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'language' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('language') }}">
          <i class="material-icons">language</i>
          <p>{{ __('RTL Support') }}</p>
        </a>
      </li> --}}
    </ul>
  </div>
</div>