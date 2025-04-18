<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/student.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
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
                
                <div class="mt-auto" style="position: absolute; bottom: 20px; width: calc(100% - 30px);">
                    <div class="dropdown">
                        <a href="javascript:void(0)" onclick="toggleStudentMenu()">
                            <i class="fas fa-user-graduate mr-2"></i>
                            <span>{{ ucfirst(auth()->guard('student')->user()->Fname) }}</span>
                            <i class="fas fa-chevron-down submenu-icon ml-auto" id="studentIcon"></i>
                        </a>
                        <div class="submenu" id="studentSubmenu">
                            <a href="{{ route('student.profile') }}" class="submenu-item">
                                <i class="fas fa-user-circle mr-2"></i>{{ __('site.sidebar.profile') }}
                            </a>
                            <form action="{{ route('student.logout') }}" method="POST">
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

        function toggleStudentMenu() {
            const submenu = document.getElementById('studentSubmenu');
            const icon = document.getElementById('studentIcon');
            
            submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
            icon.classList.toggle('active');
        }
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const dropdown = document.querySelector('.dropdown');
            const submenu = document.getElementById('studentSubmenu');
            const icon = document.getElementById('studentIcon');
            
            if (!dropdown.contains(e.target)) {
                submenu.style.display = 'none';
                icon.classList.remove('active');
            }
        });
    </script>
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
