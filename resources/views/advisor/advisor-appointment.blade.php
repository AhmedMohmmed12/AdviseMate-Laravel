<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Appointment</title>
    <link rel="stylesheet" href="{{asset('/css/styles.css')}}">

</head>
<body>
    
<x-advsidebar>

</x-advsidebar>
<div class="main-content">
    <h1 class="header">Manage Appointments</h1>
    
    <div class="appointment-controls">
        <button class="action-button">
            <i class="fas fa-plus"></i> New Office Hours
        </button>
    </div>

    <div class="calendar-card">
        <h2 class="card-title"><i class="fas fa-calendar-alt"></i> Appointment Calendar</h2>
        <div class="calendar">
            <!-- Interactive calendar integration would go here -->
            <p>Calendar integration (e.g., FullCalendar.js)</p>
        </div>
    </div>

    <div class="appointment-list">
        <h2><i class="fas fa-list"></i> Upcoming</h2>
        <div class="appointment-item">
            <strong>Jane Smith - Course Selection</strong>
            <p>Tomorrow 10:00 AM</p>
            <button class="btn-approve">Approve</button>
            <button class="btn-reschedule">Reschedule</button>
        </div>
    </div>
</div>

</body>
</html>