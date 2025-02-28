<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ Auth::user()->userProfile->profile_photo ? asset('users_profile/' . Auth::user()->userProfile->profile_photo) : asset('users_profile/default-profile.png') }}" alt="profile" />
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{ Auth::user()->name }}</span>
                    <span class="text-secondary text-small">Admin</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                aria-controls="ui-basic">
                <span class="menu-title">Drivers</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.drivers.all') }}">All Drivers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.drivers.import') }}">Import Drivers</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#local-drivers" aria-expanded="false"
                aria-controls="local-drivers">
                <span class="menu-title">Local Drivers</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </a>
            <div class="collapse" id="local-drivers">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.local.drivers.all') }}">All Drivers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.local.drivers.import') }}">Import Drivers</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                <span class="menu-title">Users</span>
                <i class="mdi mdi-contacts menu-icon"></i>
            </a>
            <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users.all') }}">All Users</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#deliveries" aria-expanded="false" aria-controls="deliveries">
                <span class="menu-title">Deliveries</span>
                <i class="mdi mdi-truck menu-icon"></i>
            </a>
            <div class="collapse" id="deliveries">
                <ul class="nav flex-column sub-menu">
                    <!-- Distance Deliveries -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.delivery.distance.direct') }}">Distance - Direct</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.delivery.distance.partner') }}">Distance - Partner</a>
                    </li>
                    <!-- Vicinity Deliveries -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.delivery.vicinity') }}">Vicinity</a>
                    </li>
                </ul>
            </div>
        </li>


        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#forms" aria-expanded="false" aria-controls="forms">
                <span class="menu-title">Businesses</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
            <div class="collapse" id="forms">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.businesses.import') }}">Import Businesses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.businesses.all') }}">All Businesses</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false"
                aria-controls="charts">
                <span class="menu-title">Partner Homes</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
            </a>
            <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.partners.import') }}">Import Partner Homes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.partners.all') }}">All Partner Homes</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
