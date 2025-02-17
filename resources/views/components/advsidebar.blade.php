<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @if (app()->getLocale() == 'ar')
    <style>
        .sidebar {
            text-align: right;
        }
        .nav-item i {
            transform: scaleX(-1);
            margin-left: 8px;
            margin-right: 0;
        }
    </style>
    @endif
</head>
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

    <div class="profile-section">
        <a href="#" class="nav-item">
            <i class="fas fa-cog"></i>
            <span class="nav-text">{{trans('site.sidebar.settings')}}</span>
        </a>
    </div>
</nav>