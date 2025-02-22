<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<!-- Sidebar -->
<nav class="sidebar">
    <div class="logo">{{trans('site.sidebar.logo')}}</div>
    
    <a href="{{ route('student.dashboard') }}" class="nav-item">
        <i class="fas fa-home"></i>
        <span class="nav-text">{{trans('site.sidebar.home')}}</span>
    </a>
    
    <a href="{{ route('student.ticket') }}" class="nav-item">
        <i class="fas fa-ticket-alt"></i>
        {{trans('site.sidebar.tickets')}}
    </a>
    
    <a href="{{ route('student.appointment') }}" class="nav-item">
        <i class="fas fa-calendar-check"></i>
        {{trans('site.sidebar.appointments')}}
    </a>
    
    <a href="#" class="nav-item">
        <i class="fas fa-user"></i>
        {{trans('site.sidebar.profile')}}
    </a>

    <div class="profile-section">
        <a href="#" class="nav-item">
            <i class="fas fa-cog"></i>
            {{trans('site.sidebar.settings')}}
        </a>
    </div>
</nav>