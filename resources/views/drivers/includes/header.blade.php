<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <a class="navbar-brand brand-logo" href="{{ route('driver.dashboard') }}">
            <img src="{{ asset('assets/images/logo.png') }}" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('driver.dashboard') }}">
            <img src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" />
        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <div class="block">
            <div id="google_translate_element"></div>
        </div>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <div class="nav-profile-img">
                        <img src="{{ Auth::user()->driver->profile_photo ? asset('drivers_profile/' . Auth::user()->driver->profile_photo) : asset('users_profile/default-profile.png') }}" alt="image">
                        <span class="availability-status online"></span>
                    </div>
                    <div class="nav-profile-text">
                        <p class="mb-1 text-black">{{ Auth::user()->name }}</p>
                    </div>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="{{ route('driver.profile.edit') }}">
                        <i class="mdi mdi-cached me-2 text-success"></i> Profile </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();">
                        <form action="{{ route('logout') }}" id="logout-form-header" method="post">
                            @csrf
                        </form>
                        <i class="mdi mdi-logout me-2 text-primary"></i> Signout
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                    data-bs-toggle="dropdown">
                    <i class="mdi mdi-bell-outline"></i>
                    @if ($notifications->count() > 0)
                        <span class="count-symbol bg-danger"></span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list"
                    aria-labelledby="notificationDropdown">
                    <h6 class="p-3 mb-0">Notifications</h6>
                    @foreach ($notifications as $notification)
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                            {{-- <div class="preview-thumbnail">
                                <div class="preview-icon bg-success">
                                    <i class="mdi mdi-calendar"></i>
                                </div>
                            </div> --}}
                            <div
                                class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                <h6 class="preview-subject font-weight-normal mb-1">{{ $notification->title }}</h6>
                                <p class="text-gray ellipsis mb-0"> {{ $notification->message }} </p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                    @endforeach
                    @if ($notifications->count() > 0)
                        <h6 class="p-3 mb-0 text-center">
                            <a href="{{ route('driver.notifications') }}">See all notifications</a>
                        </h6>
                    @else
                        <h6 class="p-3 mb-0 text-center">No notifications</h6>
                    @endif
                </div>
            </li>
            <li class="nav-item nav-logout d-none d-lg-block">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="nav-link">
                        <i class="mdi mdi-power"></i>
                    </button>
                </form>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
