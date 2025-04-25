<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/advisor.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        
        @if(auth()->user()->hasRole('advisor'))
            <a href="{{ route('advisor.dashboard') }}" class="{{ request()->routeIs('advisor.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home mr-2"></i>{{ trans('site.sidebar.home') }}
            </a>
            <a href="{{ route('advisor.ticket') }}" class="{{ request()->routeIs('advisor.ticket') ? 'active' : '' }}">
                <i class="fas fa-ticket-alt mr-2"></i>{{trans('site.sidebar.tickets')}}
            </a>
            <a href="{{ route('advisor.appointment') }}" class="{{ request()->routeIs('advisor.appointment') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt mr-2"></i>{{trans('site.sidebar.appointments')}}
            </a>
            <a href="{{ route('advisor.student') }}" class="{{ request()->routeIs('advisor.student') ? 'active' : '' }}">
                <i class="fas fa-user-graduate mr-2"></i>{{trans('site.advisor.students.title')}}
            </a>
        @endif

        @if(auth()->check() && auth()->user()->hasRole('super_admin'))
            <a href="{{ route('supervisor.dashboard') }}" class="{{ request()->routeIs('supervisor.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home mr-2"></i>{{ trans('site.sidebar.home') }}
            </a>
            
            <!-- Supervisor-Only Navigation Items -->
            <a href="javascript:void(0)" onclick="toggleSubmenu()" class="{{ request()->routeIs('supervisor.index', 'supervisor.permission') ? 'active' : '' }}">
                <i class="fas fa-users-cog mr-2"></i>{{ trans('site.supervisor.users.manage_users') }}
                <i class="fas fa-chevron-down submenu-icon ml-auto"></i>
            </a>
            <div class="submenu" id="userManagementSubmenu">
                <a href="{{ route('supervisor.index') }}" class="submenu-item {{ request()->routeIs('supervisor.index') ? 'active' : '' }}">
                    <i class="fas fa-users mr-2"></i>{{ trans('site.supervisor.users.manage_users') }}
                </a>
                <a href="{{ route('supervisor.permission') }}" class="submenu-item {{ request()->routeIs('supervisor.permission') ? 'active' : '' }}">
                    <i class="fas fa-key mr-2"></i>{{ trans('site.supervisor.users.manage_advisor') }}
                </a>
            </div>
            <a href="{{ route('supervisor.activity-log') }}" class="{{ request()->routeIs('supervisor.activity-log') ? 'active' : '' }}">
                <i class="fas fa-chart-line mr-2"></i>{{ __('site.supervisor.activity_log.title') }}
            </a>
        @endif
        
        <div class="mt-auto" style="position: absolute; bottom: 20px; width: calc(100% - 30px);">
            <div class="dropdown">
                <a href="javascript:void(0)" onclick="toggleSuperadminMenu()">
                    <i class="fas fa-user-shield mr-2"></i>{{ ucfirst(auth()->user()->fName) }}
                    <i class="fas fa-chevron-down submenu-icon ml-auto" id="superadminIcon"></i>
                </a>
                <div class="submenu" id="superadminSubmenu">
                    @if(auth()->user()->hasRole('advisor'))
                        <a href="{{ route('advisor.profile') }}" class="submenu-item">
                            <i class="fas fa-user-circle mr-2"></i>{{ __('site.sidebar.profile') }}
                        </a>
                    @elseif(auth()->user()->hasRole('super_admin'))
                        <a href="{{ route('supervisor.profile') }}" class="submenu-item">
                            <i class="fas fa-user-circle mr-2"></i>{{ __('site.sidebar.profile') }}
                        </a>
                    @endif
                    <form action="{{ auth()->user()->hasRole('advisor') ? route('logout') : route('supervisor.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="submenu-item btn btn-link w-100 text-left">
                            <i class="fas fa-sign-out-alt mr-2"></i>{{ __('site.sidebar.logout') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
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
        
        function toggleSubmenu() {
            const submenu = document.getElementById('userManagementSubmenu');
            const icon = document.querySelector('.submenu-icon');
            
            if (submenu.style.display === 'none' || submenu.style.display === '') {
                submenu.style.display = 'block';
                icon.classList.add('active');
            } else {
                submenu.style.display = 'none';
                icon.classList.remove('active');
            }
        }
        
        function toggleSuperadminMenu() {
            const submenu = document.getElementById('superadminSubmenu');
            const icon = document.getElementById('superadminIcon');
            
            if (submenu.style.display === 'none' || submenu.style.display === '') {
                submenu.style.display = 'block';
                icon.classList.add('active');
            } else {
                submenu.style.display = 'none';
                icon.classList.remove('active');
            }
        }
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown')) {
                const dropdowns = document.querySelectorAll('.dropdown-menu');
                dropdowns.forEach(function(dropdown) {
                    dropdown.style.display = 'none';
                });
            }
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>