<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <a class="navbar-brand brand-logo" href="{{ route('main') }}">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('main') }}">
            <img src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" />
        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <div class="">
                        <strong>
                            Create Account
                        </strong>
                    </div>
                    <div class="nav-profile-text">
                    </div>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="{{ route('driver.register') }}">
                        <i class="mdi mdi-cached me-2 text-success"></i> Register as Driver</a>
                    <div class="dropdown-divider"></div>
                    {{-- <a class="dropdown-item" href="{{ route('user.register') }}">
                        <i class="mdi mdi-logout me-2 text-primary"></i> Register as User
                    </a> --}}
                </div>
            </li>
            
            
            <li class="nav-item nav-settings d-none d-lg-block">
                <a class="nav-link" href="{{ route('login') }}">
                    <strong>
                        Login
                    </strong>
                </a>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
