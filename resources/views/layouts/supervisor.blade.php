<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('site.supervisor.dashboard.title') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @if(app()->getLocale()=='en')
    <link rel="stylesheet" href="{{ asset('css/supervisor.css') }}">
    @else
    <link rel="stylesheet" href="{{ asset('css/supervisor.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    @endif
    

    @if(app()->getLocale()=='ar')
    <style>
        .rtl {
    direction: rtl;
    text-align: right;
}

.font-cairo {
    font-family: 'Cairo';
}

.rtl .ml-auto {
    margin-left: unset !important;
    margin-right: auto !important;
}

.rtl .mr-auto {
    margin-right: unset !important;
    margin-left: auto !important;
}
    </style>
    @endif
</head>
<body class="{{ app()->getLocale() === 'ar' ? 'rtl font-cairo' : '' }}">
    <nav class="supervisor-navbar">
        <div class="navbar-container">
            <a class="navbar-brand" href="#">
                <i class="fa-solid fa-user-shield"></i> {{ __('site.supervisor.dashboard.title') }}
            </a>
            <div class="nav-links">
                @if (auth()->user()->hasRole('super_admin'))
                <a href="{{ route('supervisor.dashboard') }}" class="nav-item>">
                    <i class="fa-solid fa-gauge"></i> {{ __('site.sidebar.home') }}
                </a>
                @endif
               
                
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="usersDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-users"></i> {{ __('site.supervisor.users.title') }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('index') }}">
                            <i class="fa-solid fa-user-group"></i> {{ __('site.supervisor.users.manage_users') }}
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('permission') }}">
                            <i class="fa-solid fa-key"></i> {{ __('site.supervisor.users.manage_permissions') }}
                        </a></li>
                    </ul>
                </div>
                <a href="{{ route('supervisor.activity-log') }}" class="nav-item">
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