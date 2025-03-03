<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('site.supervisor.dashboard.title') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/supervisor.css') }}">
</head>
<body>
    <nav class="supervisor-navbar">
        <div class="navbar-container">
            <a class="navbar-brand" href="#">
                <i class="fa-solid fa-user-shield"></i> {{ __('site.supervisor.dashboard.title') }}
            </a>
            <div class="nav-links">
                <a href="{{ route('supervisor.dashboard') }}" class="nav-item {{ Request::is('supervisor/dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-gauge"></i> {{ __('site.sidebar.home') }}
                </a>
                <a href="{{ route('index') }}" class="nav-item">
                    <i class="fa-solid fa-users"></i> {{ __('site.supervisor.users.title') }}
                </a>
                <a href="{{ route('supervisor.activity-log') }}" class="nav-item {{ Request::is('supervisor/activity-log') ? 'active' : '' }}">
                    <i class="fa-solid fa-clock-rotate-left"></i> {{ __('site.supervisor.activity_log.title') }}
                </a>
            </div>
            <div class="user-dropdown">
                <button class="dropdown-toggle">
                    <i class="fa-solid fa-circle-user"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#"><i class="fa-solid fa-gear"></i> {{ __('site.sidebar.profile') }}</a>
                    <a class="dropdown-item" href="#"><i class="fa-solid fa-right-from-bracket"></i> {{ __('site.login.login_button') }}</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="main-content">
        @include('partials._success')
        @include('partials._error')
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>