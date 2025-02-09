<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets</title>
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
            
            <a href="appointment.html" class="nav-item">
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
            <h1 class="header">Tickets</h1>
            
            <div class="tickets-section">
                <div class="new-ticket">
                    <button class="action-button">
                        <i class="fas fa-plus"></i> Create New Ticket
                    </button>
                </div>
                <ul class="ticket-list">
                    <li class="ticket-item">
                        <div class="ticket-title">
                            Registration Issue
                        </div>
                        <div class="ticket-meta">
                            <span class="status-indicator status-open">Open</span>
                        </div>
                    </li>
                    <li class="ticket-item">
                        <div class="ticket-title">
                            Course Deletion Request
                        </div>
                        <div class="ticket-meta">
                            <span class="status-indicator status-closed">Closed</span>
                        </div>
                    </li>
                    <li class="ticket-item">
                        <div class="ticket-title">
                            Financial Aid Question
                        </div>
                        <div class="ticket-meta">
                            <span class="status-indicator status-open">Open</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
