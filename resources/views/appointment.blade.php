@extends('layouts.HeadStudent')
@section('name')
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
@endsection