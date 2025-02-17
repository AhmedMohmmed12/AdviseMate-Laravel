<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{trans('site.advisor.appointments.title')}}</title>
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
        .action-button i,
        .card-title i,
        .btn-approve i,
        .btn-reschedule i {
            transform: scaleX(-1);
            margin-left: 8px;
            margin-right: 0;
        }
        .calendar-card,
        .appointment-item {
            text-align: right;
        }
    </style>
    @endif
</head>
<body>
    <x-advsidebar />
    
    <div class="main-content">
        <h1 class="header">{{trans('site.advisor.appointments.title')}}</h1>
        
        <div class="appointment-controls">
            <button class="action-button">
                <i class="fas fa-plus"></i> 
                {{trans('site.advisor.appointments.new_hours')}}
            </button>
        </div>

        <div class="calendar-card">
            <h2 class="card-title">
                <i class="fas fa-calendar-alt"></i> 
                {{trans('site.advisor.appointments.calendar')}}
            </h2>
            <div class="calendar">
                <!-- Interactive calendar integration would go here -->
                <p>Calendar integration (e.g., FullCalendar.js)</p>
            </div>
        </div>

        <div class="appointment-list">
            <h2>
                <i class="fas fa-list"></i> 
                {{trans('site.advisor.appointments.upcoming')}}
            </h2>
            <div class="appointment-item">
                <strong>Ali - {{trans('site.advisor.appointments.course_selection')}}</strong>
                <p>Tomorrow 10:00 AM</p>
                <button class="btn-approve">
                    <i class="fas fa-check"></i>
                    {{trans('site.advisor.appointments.approve')}}
                </button>
                <button class="btn-reschedule">
                    <i class="fas fa-clock"></i>
                    {{trans('site.advisor.appointments.reschedule')}}
                </button>
            </div>
        </div>
    </div>
</body>
</html>