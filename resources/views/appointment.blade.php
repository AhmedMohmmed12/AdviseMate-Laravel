<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/css/styles.css')}}">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="logo">AdvisorMate</div>
            
            <a href="dashboard.html" class="nav-item">
                <i class="fas fa-home"></i>
                <span class="nav-text">Home</span>
            </a>
            
            <a href="ticket.html" class="nav-item">
                <i class="fas fa-ticket-alt"></i>
                Tickets
            </a>
            
            <a href="#" class="nav-item">
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

        <!-- Main Content -->
        <div class="main-content">
            <h1 class="header">Appointments</h1>

            <div class="appointments-section">
                <div class="new-appointment">
                    <button class="action-button">
                        <i class="fas fa-calendar-plus"></i> Schedule New Appointment
                    </button>
                </div>
                <ul class="appointment-list">
                    <li class="appointment-item">
                        <div class="appointment-title">
                            Advisor Meeting
                        </div>
                        <div class="appointment-meta">
                            <span class="status-indicator status-upcoming">Upcoming</span>
                        </div>
                    </li>
                    <li class="appointment-item">
                        <div class="appointment-title">
                            Career Counseling
                        </div>
                        <div class="appointment-meta">
                            <span class="status-indicator status-completed">Completed</span>
                        </div>
                    </li>
                    <li class="appointment-item">
                        <div class="appointment-title">
                            Financial Aid Discussion
                        </div>
                        <div class="appointment-meta">
                            <span class="status-indicator status-upcoming">Upcoming</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
