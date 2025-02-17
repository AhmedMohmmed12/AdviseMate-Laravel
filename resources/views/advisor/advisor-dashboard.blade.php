<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{trans('site.advisor.dashboard.welcome')}}</title>
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

    @if (app()->getLocale() == 'ar')
    <style>
        .stat-card i,
        .card-title i,
        .action-button i {
            transform: scaleX(-1);
            margin-left: 8px;
            margin-right: 0;
        }
    </style>
    @endif
</head>
<body>
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