<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket</title>
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
    <x-advsidebar>

    </x-advsidebar>
<div class="main-content">
    <h1 class="header">Student Tickets</h1>
    
    <div class="filters">
        <select id="status-filter">
            <option>All</option>
            <option>Open</option>
            <option>Closed</option>
        </select>
    </div>

    <div class="tickets-table">
        <div class="ticket-header">
            <div>Student</div>
            <div>Issue</div>
            <div>Priority</div>
            <div>Actions</div>
        </div>
        <div class="ticket-item">
            <div>Khalid</div>
            <div>Cannot enroll in CS101</div>
            <div><span class="priority-high">High</span></div>
            <div>
                <button class="btn-respond"><i class="fas fa-close"></i></button>
                <button class="btn-close"><i class="fas fa-check"></i></button>
            </div>
        </div>
    </div>
</div>

</body>
</html>