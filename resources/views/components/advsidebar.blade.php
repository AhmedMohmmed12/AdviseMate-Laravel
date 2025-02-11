<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<!-- Sidebar -->
<nav class="sidebar">
    <div class="logo">AdvisorMate</div>
    
    <a href="{{ route('advisor.dashboard') }}" class="nav-item">
        <i class="fas fa-home"></i>
        <span class="nav-text">Dashboard</span>
    </a>
    
    <a href="{{ route('advisor.ticket') }}" class="nav-item">
        <i class="fas fa-ticket-alt"></i>
        Tickets
    </a>
    
    <a href="{{ route('advisor.appointment') }}" class="nav-item">
        <i class="fas fa-calendar-check"></i>
        Appointments
    </a>
    
    <a href="{{ route('advisor.student') }}" class="nav-item">
        <i class="fas fa-users"></i>
        Students
    </a>

    <div class="profile-section">
        <a href="#" class="nav-item">
            <i class="fas fa-cog"></i>
            Settings
        </a>
    </div>
</nav>