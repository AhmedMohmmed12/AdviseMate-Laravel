<!-- Sidebar -->
<nav class="sidebar">
    <div class="logo">AdvisorMate</div>
    
    <a href="{{ route('dashboard') }}" class="nav-item">
        <i class="fas fa-home"></i>
        <span class="nav-text">Home</span>
    </a>
    
    <a href="{{ route('ticket') }}" class="nav-item">
        <i class="fas fa-ticket-alt"></i>
        Tickets
    </a>
    
    <a href="{{ route('appointment') }}" class="nav-item">
        <i class="fas fa-calendar-check"></i>
        Appointments
    </a>
    
    <a href="#" class="nav-item">
        <i class="fas fa-user"></i>
        Profile
    </a>

    <div class="profile-section">
        <a href="#" class="nav-item">
            <i class="fas fa-cog"></i>
            Settings
        </a>
    </div>
</nav>