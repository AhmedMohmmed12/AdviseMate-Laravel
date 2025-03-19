<!-- Sidebar -->
<nav class="sidebar">
    <div class="logo">{{trans('site.sidebar.logo')}}</div>
    
    <a href="{{ route('advisor.dashboard') }}" class="nav-item">
        <i class="fas fa-home"></i>
        <span class="nav-text">{{trans('site.sidebar.home')}}</span>
    </a>
    
    <a href="{{ route('advisor.ticket') }}" class="nav-item">
        <i class="fas fa-ticket-alt"></i>
        <span class="nav-text">{{trans('site.sidebar.tickets')}}</span>
    </a>
    
    <a href="{{ route('advisor.appointment') }}" class="nav-item">
        <i class="fas fa-calendar-check"></i>
        <span class="nav-text">{{trans('site.sidebar.appointments')}}</span>
    </a>
    
    <a href="{{ route('advisor.student') }}" class="nav-item">
        <i class="fas fa-users"></i>
        <span class="nav-text">{{trans('site.advisor.students.title')}}</span>
    </a>
    @if(auth()->user()->hasRole('super_admin'))
    <a href="{{ route('supervisor.index') }}" class="nav-item">
        <i class="fa-solid fa-user-group"></i>
        <span class="nav-text">{{ trans('site.supervisor.users.manage_users') }}</span>
    </a>

    <a href="{{ route('supervisor.activity-log') }}" class="nav-item {{ request()->routeIs('supervisor.activity-log') ? 'active' : '' }}">
        <i class="fa-solid fa-clock-rotate-left"></i> {{ __('site.supervisor.activity_log.title') }}
    </a>
    @endif

    <div class="nav-item user-dropdown profile-section">
        <button class="dropdown-toggle" data-bs-toggle="dropdown">
            <i class="fa-solid fa-circle-user"></i>
            <span class="nav-text">{{ ucfirst(auth()->user()->fName) }}</span>
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('supervisor.profile') }}">
                <i class="fa-solid fa-gear"></i> {{ __('site.sidebar.profile') }}
            </a>
            <form action="{{ route('supervisor.logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item">
                    <i class="fa-solid fa-right-from-bracket"></i> {{ __('site.sidebar.logout') }}
                </button>
            </form>
        </div>
    </div>
    
    {{-- <div class="profile-section">
        <a href="#" class="nav-item">
            <i class="fas fa-cog"></i>
            <span class="nav-text">{{trans('site.sidebar.settings')}}</span>
        </a>
    </div> --}}
</nav>

<style>
    .sidebar {
        width: 250px;
        height: 100vh;
        background: #DDAD27;
        padding: 20px;
        position: fixed;
        top: 0;
        left: 0;
        transition: all 0.3s;
    }
    .nav-item {
        display: flex;
        align-items: center;
        padding: 10px;
        color: #fff;
        text-decoration: none;
    }
    .nav-item .nav-text {
        margin-left: 10px;
    }
    .user-dropdown .dropdown-toggle {
        background: none;
        border: none;
        color: #fff;
        display: flex;
        align-items: center;
        padding: 10px;
        width: 100%;
        text-align: left;
    }
    .user-dropdown .dropdown-toggle .nav-text {
        margin-left: 10px;
    }
    .dropdown-menu {
        background-color: #343a40;
        border: none;
    }
    .dropdown-item {
        color: #fff;
    }
    .dropdown-item:hover {
        background-color: #495057;
    }
</style>