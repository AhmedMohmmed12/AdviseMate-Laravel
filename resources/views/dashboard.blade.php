@extends('layouts.AdviseMate')
@section('title', 'Dashboard')
@section('content')
<main class="col-12 col-md-9 col-lg-10 ml-auto px-3 py-4 content">
    <div class="mt-4 mb-4">
        <!-- Main Content -->
        <div class="main-content">
            <h1 class="header">Welcome Back, Student!</h1>
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
    </main>
    </div>
@endsection