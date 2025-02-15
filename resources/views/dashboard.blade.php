<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">  
    @if (app()->getLocale() == 'en')
    <link rel="stylesheet" href="{{asset('/css/styles.css')}}">
    @else
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style-ar.css')}}">
    @endif
</head>
<body>
    <div class="container">
        <x-sidebar>
            
        </x-sidebar>

        <!-- Main Content -->
        <div class="main-content">
            <h1 class="header">{{trans('site.home')}} Back, Student!</h1>
            <div class="dashboard-grid">
                <!-- Upcoming Appointments Card -->
                <div class="dashboard-card">
                    <h2 class="card-title"><i class="fas fa-calendar-alt"></i> Upcoming Appointments</h2>
                    <ul class="appointment-list">
                        <li class="appointment-item">
                            <strong>Advisor Meeting</strong><br>
                            <span class="text-muted">Tomorrow 2:00 PM</span>
                        </li>
                        <li class="appointment-item">
                            <strong>Course Selection</strong><br>
                            <span class="text-muted">Friday 10:30 AM</span>
                        </li>
                    </ul>
                </div>

                <!-- Recent Tickets Card -->
                <div class="dashboard-card">
                    <h2 class="card-title"><i class="fas fa-ticket-alt"></i> Recent Tickets</h2>
                    <ul class="appointment-list">
                        <li class="appointment-item">
                            <strong>Registration Issue</strong>
                            <span class="status-indicator status-open">Open</span>
                        </li>
                        <li class="appointment-item">
                            <strong>Course deletion</strong>
                            <span class="status-indicator status-closed">Closed</span>
                        </li>
                    </ul>
                </div>

                <!-- Quick Actions Card -->
                <div class="dashboard-card">
                    <h2 class="card-title"><i class="fas fa-bolt"></i> Quick Actions</h2>
                    <div class="quick-actions">
                        <button class="action-button">
                            <i class="fas fa-plus"></i> New Ticket
                        </button>
                        <button class="action-button">
                            <i class="fas fa-calendar-plus"></i> Schedule Meeting
                        </button>
                    </div>
                </div>

                <!-- Calendar Card -->
                <div class="dashboard-card">
                    <h2 class="card-title"><i class="fas fa-calendar"></i> Academic Calendar</h2>
                    <div class="calendar-placeholder">
                        Interactive Calendar (Coming Soon)
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>