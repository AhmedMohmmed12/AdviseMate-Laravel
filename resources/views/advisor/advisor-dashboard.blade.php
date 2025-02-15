<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advisor Dashboard</title>
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
<x-advsidebar>

</x-advsidebar>
        <!-- Main Content -->
        <div class="main-content">
            <h1 class="header">Welcome Back, Advisor!</h1>
            
            <!-- Stats Overview -->
            <div class="stats-grid">
                <div class="stat-card">
                    <i class="fas fa-users"></i>
                    <h3>Total Students</h3>
                    <p>45</p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-ticket-alt"></i>
                    <h3>Pending Tickets</h3>
                    <p>12</p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-calendar"></i>
                    <h3>Upcoming Appointments</h3>
                    <p>5</p>
                </div>
            </div>

            <div class="dashboard-grid">
                <!-- Recent Tickets Card -->
                <div class="dashboard-card">
                    <h2 class="card-title"><i class="fas fa-ticket-alt"></i> Recent Student Tickets</h2>
                    <ul class="appointment-list">
                        <li class="appointment-item">
                            <strong>Faris: Graduation Audit</strong>
                            <span class="status-indicator status-open">Urgent</span>
                        </li>
                        <li class="appointment-item">
                            <strong>Mohammed: Course Overload</strong>
                            <span class="status-indicator status-pending">In Review</span>
                        </li>
                    </ul>
                </div>

                <!-- Today's Appointments Card -->
                <div class="dashboard-card">
                    <h2 class="card-title"><i class="fas fa-calendar-day"></i> Today's Appointments</h2>
                    <ul class="appointment-list">
                        <li class="appointment-item">
                            <strong>Meeting with Ahmed</strong><br>
                            <span class="text-muted">2:00 PM - Course Advising</span>
                        </li>
                    </ul>
                </div>

                <!-- Quick Actions Card -->
                <div class="dashboard-card">
                    <h2 class="card-title"><i class="fas fa-bolt"></i> Quick Actions</h2>
                    <div class="quick-actions">
                        <button class="action-button">
                            <i class="fas fa-ticket"></i> View All Tickets
                        </button>
                        <button class="action-button">
                            <i class="fas fa-clock"></i>View All Appointments
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>