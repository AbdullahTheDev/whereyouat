<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
          <div class="nav-profile-image">
            <img src="{{ Auth::user()->driver->profile_photo ? asset('drivers_profile/' . Auth::user()->driver->profile_photo) : asset('users_profile/default-profile.png') }}" alt="profile" />
            <span class="login-status online"></span>
            <!--change to offline or busy as needed-->
          </div>
          <div class="nav-profile-text d-flex flex-column">
            <span class="font-weight-bold mb-2">{{ Auth::user()->name }}</span>
            <span class="text-secondary text-small">Driver</span>
          </div>
          <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('driver.dashboard') }}">
          <span class="menu-title">Dashboard</span>
          <i class="mdi mdi-home menu-icon"></i>
        </a>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-title">Trips</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-crosshairs-gps menu-icon"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('driver.trips.announce') }}">Announce Trip</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('driver.trips.history') }}">Trips History</a>
            </li>
          </ul>
        </div>
      </li> --}}
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
          <span class="menu-title">Delivery</span>
          <i class="mdi mdi-contacts menu-icon"></i>
        </a>
        <div class="collapse" id="icons">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('driver.delivery.distance') }}">Distance Delivery</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('driver.delivery.vicinity') }}">Vicinity Delivery</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('driver.delivery.your') }}">My Deliveries</a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </nav>