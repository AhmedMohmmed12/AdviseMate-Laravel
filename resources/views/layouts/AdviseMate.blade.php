<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/student.css') }}">
</head>
<body>
    <div class="mobile-nav">
        <div class="menu-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </div>
        <h2>{{ trans('site.sidebar.logo') }}</h2>
    </div>
    <div class="container-fluid p-0">
        <div class="row no-gutters">
    <nav class="col-md-3 col-lg-2 sidebar" id="sidebar">
        <h2>{{ trans('site.sidebar.logo') }}</h2>
        <a href="{{ route('student.dashboard') }}" class="{{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
            <i class="fas fa-home mr-2"></i>{{ trans('site.sidebar.home') }}
        </a>
        <a href="{{ route('student.ticket') }}" class="{{ request()->routeIs('student.ticket') ? 'active' : '' }}">
            <i class="fas fa-ticket-alt mr-2"></i>{{ trans('site.sidebar.tickets') }}
        </a>
        <a href="{{ route('student.appointment') }}" class="{{ request()->routeIs('student.appointment') ? 'active' : '' }}">
            <i class="fas fa-calendar-alt mr-2"></i>{{ trans('site.sidebar.appointments') }}
        </a>
        <a href="#" class="{{ request()->routeIs('student.profile') ? 'active' : '' }}">
            <i class="fas fa-user mr-2"></i>{{ trans('site.sidebar.profile') }}
        </a>
        <a href="#" class="{{ request()->routeIs('student.settings') ? 'active' : '' }}">
            <i class="fas fa-cog mr-2"></i>{{ trans('site.sidebar.settings') }}
        </a>
    </nav>
    </div>
</div>
    <main>
        @yield('content')
    </main>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }
    </script>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</body>
</html>
