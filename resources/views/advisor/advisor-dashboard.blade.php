@extends('layouts.HeadAdvisor')
@section('content')
    <div class="container">
        <x-advsidebar />
        
        <div class="main-content">
            <h1 class="header">{{trans('site.advisor.dashboard.welcome')}}</h1>
            
            <!-- Stats Overview -->
            <div class="stats-grid">
                <div class="stat-card">
                    <i class="fas fa-users"></i>
                    <h3>{{trans('site.advisor.dashboard.stats.total_students')}}</h3>
                    <p>45</p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-ticket-alt"></i>
                    <h3>{{trans('site.advisor.dashboard.stats.pending_tickets')}}</h3>
                    <p>12</p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-calendar"></i>
                    <h3>{{trans('site.advisor.dashboard.stats.upcoming_appointments')}}</h3>
                    <p>5</p>
                </div>
            </div>

            <div class="dashboard-grid">
                <!-- Recent Tickets Card -->
                <div class="dashboard-card">
                    <h2 class="card-title"><i class="fas fa-ticket-alt"></i> {{trans('site.advisor.dashboard.recent_tickets')}}</h2>
                    <ul class="appointment-list">
                        <li class="appointment-item">
                            <strong>Faris: {{trans('site.advisor.dashboard.graduation_audit')}}</strong>
                            <span class="status-indicator status-open">{{trans('site.advisor.dashboard.urgent')}}</span>
                        </li>
                        <li class="appointment-item">
                            <strong>Mohammed: {{trans('site.advisor.dashboard.course_overload')}}</strong>
                            <span class="status-indicator status-pending">{{trans('site.advisor.dashboard.in_review')}}</span>
                        </li>
                    </ul>
                </div>

                <!-- Today's Appointments Card -->
                <div class="dashboard-card">
                    <h2 class="card-title"><i class="fas fa-calendar-day"></i> {{trans('site.advisor.dashboard.todays_appointments')}}</h2>
                    <ul class="appointment-list">
                        <li class="appointment-item">
                            <strong>{{trans('site.advisor.dashboard.meeting_with')}} Ahmed</strong><br>
                            <span class="text-muted">2:00 PM - {{trans('site.advisor.dashboard.course_advising')}}</span>
                        </li>
                    </ul>
                </div>

                <!-- Quick Actions Card -->
                <div class="dashboard-card">
                    <h2 class="card-title"><i class="fas fa-bolt"></i> {{trans('site.advisor.dashboard.quick_actions')}}</h2>
                    <div class="quick-actions">
                        <button class="action-button">
                            <i class="fas fa-ticket"></i> {{trans('site.advisor.dashboard.view_tickets')}}
                        </button>
                        <button class="action-button">
                            <i class="fas fa-clock"></i> {{trans('site.advisor.dashboard.view_appointments')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection