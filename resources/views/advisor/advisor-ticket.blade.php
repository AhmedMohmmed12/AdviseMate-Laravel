<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{trans('site.advisor.tickets.title')}}</title>
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
        .btn-respond i,
        .btn-close i {
            transform: scaleX(-1);
            margin-left: 8px;
            margin-right: 0;
        }
        .ticket-header,
        .ticket-item {
            text-align: right;
        }
    </style>
    @endif
</head>
<body>
    <x-advsidebar />
    <div class="main-content">
        <h1 class="header">{{trans('site.advisor.tickets.title')}}</h1>
        
        <div class="filters">
            <select id="status-filter">
                <option>{{trans('site.advisor.tickets.filters.all')}}</option>
                <option>{{trans('site.advisor.tickets.filters.open')}}</option>
                <option>{{trans('site.advisor.tickets.filters.closed')}}</option>
            </select>
        </div>

        <div class="tickets-table">
            <div class="ticket-header">
                <div>{{trans('site.advisor.tickets.table.student')}}</div>
                <div>{{trans('site.advisor.tickets.table.issue')}}</div>
                <div>{{trans('site.advisor.tickets.table.priority')}}</div>
                <div>{{trans('site.advisor.tickets.table.actions')}}</div>
            </div>
            <div class="ticket-item">
                <div>Khalid</div>
                <div>{{trans('site.advisor.dashboard.course_overload')}}</div>
                <div><span class="priority-high">{{trans('site.advisor.tickets.priority.high')}}</span></div>
                <div>
                    <button class="btn-respond" title="{{trans('site.advisor.tickets.filters.open')}}">
                        <i class="fas fa-close"></i>
                    </button>
                    <button class="btn-close" title="{{trans('site.advisor.tickets.filters.closed')}}">
                        <i class="fas fa-check"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>