<nav class="navbar navbar-expand-lg bg-body-tertiary py-0">
    <div class="container-fluid py-2"
        style="background-color: rgba(244, 247, 240, 0.7); box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 0 110px 0 110px;">

        <a class="navbar-brand fw-bolder fs-3" href="/">ConnectFriend</a>
        <ul
            class="navbar-nav flex-column flex-lg-row align-items-lg-center justify-content-lg-center w-100 gap-lg-4 fw-medium fs-6">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                    href="{{ route('home') }}">@lang('navbar.home')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('avatar.index') ? 'active' : '' }}"
                    href="{{ route('avatar.index') }}">@lang('navbar.listAvatar')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('avatar.myAvatar') ? 'active' : '' }}"
                    href="{{ route('avatar.myAvatar') }}">@lang('navbar.myAvatar')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('avatar.received') ? 'active' : '' }}"
                    href="{{ route('avatar.received') }}">@lang('navbar.received')</a>
            </li>
        </ul>

        <div class="d-flex flex-column flex-lg-row align-items-center gap-5">
            <!-- Localization Dropdown -->
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="localeDropdown" data-bs-toggle="dropdown"
                    aria-expanded="false"
                    style="background-color: #183F23; color: white; border-color: #183F23; padding: 4px 10px; font-size: 14px;">
                    {{ strtoupper(App::getLocale()) }}
                </button>
                <ul class="dropdown-menu" aria-labelledby="localeDropdown">
                    <li><a class="dropdown-item" href="{{ route('set-locale', ['locale' => 'en']) }}">English</a></li>
                    <li><a class="dropdown-item" href="{{ route('set-locale', ['locale' => 'id']) }}">Bahasa
                            Indonesia</a></li>
                </ul>
            </div>

            <!-- User Section -->
            @if (Auth::check())
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('profile.show') }}" class="d-flex align-items-center">
                        <img src="{{ asset(auth()->user()->profile_picture) }}" alt="Profile Icon" class="rounded-circle"
                            width="45" height="45">
                    </a>
                </div>
            @else
                <div class="d-flex gap-2">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">@lang('navbar.login')</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-sm">@lang('navbar.register')</a>
                </div>
            @endif
        </div>
    </div>
</nav>