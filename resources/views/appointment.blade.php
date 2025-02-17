<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
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
            <h1 class="header">{{trans('site.appointments.title')}}</h1>

            <div class="appointments-section">
                <div class="new-appointment">
                    <button class="action-button">
                        <i class="fas fa-calendar-plus"></i> {{trans('site.appointments.schedule_new')}}
                    </button>
                </div>
                <ul class="appointment-list">
                    <li class="appointment-item">
                        <div class="appointment-title">
                            {{trans('site.appointments.advisor_meeting')}}
                        </div>
                        <div class="appointment-meta">
                            <span class="status-indicator status-upcoming">{{trans('site.status.upcoming')}}</span>
                        </div>
                    </li>
                    <li class="appointment-item">
                        <div class="appointment-title">
                            {{trans('site.appointments.career_counseling')}}
                        </div>
                        <div class="appointment-meta">
                            <span class="status-indicator status-completed">{{trans('site.status.completed')}}</span>
                        </div>
                    </li>
                    <li class="appointment-item">
                        <div class="appointment-title">
                            {{trans('site.appointments.financial_discussion')}}
                        </div>
                        <div class="appointment-meta">
                            <span class="status-indicator status-upcoming">{{trans('site.status.upcoming')}}</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
