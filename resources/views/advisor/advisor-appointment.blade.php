@extends('layouts.HeadAdvisor')
@section('content')
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
@endsection