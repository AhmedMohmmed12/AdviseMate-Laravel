@extends('layouts.AdviseMateAdvisor')
@section('title','Dashboard')
@section('content')

            <main class="col-12 col-md-9 col-lg-10 ml-auto px-3 py-4 content">
                <div class="mt-4 mb-4">
                    <h2>{{trans('site.advisor.dashboard.welcome')}}, {{ ucfirst(Auth::user()->fName) }}!</h2>
                </div>
                
                <!-- Stats Row -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <h3>{{trans('site.advisor.dashboard.stats.total_students')}}</h3>
                            <div class="number">{{ $totalStudents }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-ticket-alt"></i>
                            </div>
                            <h3>{{trans('site.advisor.dashboard.stats.pending_tickets')}}</h3>
                            <div class="number">{{ $pendingTickets }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <h3>{{trans('site.advisor.dashboard.stats.upcoming_appointments')}}</h3>
                            <div class="number">{{ $upcomingAppointments }}</div>
                        </div>
                    </div>
                </div>
                
                <!-- Activity Row -->
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="activity-card">
                            <h3><i class="fas fa-ticket-alt mr-2"></i>{{trans('site.advisor.dashboard.recent_tickets')}}</h3>
                            @forelse($recentTickets as $ticket)
                            <div class="activity-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <strong>{{ ucfirst($ticket->student->Fname ?? 'Student') }}: {{ $ticket->ticketType->ticket_type ?? trans('site.advisor.dashboard.ticket') }}</strong>
                                    </div>
                                    <span class="badge badge-{{ $ticket->ticket_status == 'pending' ? 'warning' : ($ticket->ticket_status == 'completed' ? 'success' : 'danger') }}">
                                        {{ $ticket->ticket_status == 'pending' ? trans('site.advisor.dashboard.pending') : 
                                        ($ticket->ticket_status == 'completed' ? trans('site.advisor.dashboard.completed') : 
                                        trans('site.advisor.dashboard.rejected')) }}
                                    </span>
                                </div>
                            </div>
                            @empty
                            <div class="activity-item">
                                <p>{{trans('site.advisor.dashboard.no_recent_tickets')}}</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="activity-card">
                            <h3><i class="fas fa-calendar-alt mr-2"></i>{{trans('site.advisor.dashboard.todays_appointments')}}</h3>
                            @forelse($todaysAppointments as $appointment)
                            <div class="activity-item">
                                <div>
                                    <strong>{{trans('site.advisor.dashboard.meeting_with')}} {{ ucfirst($appointment->student->Fname ?? 'Student') }}</strong>
                                    <div>{{ \Carbon\Carbon::parse($appointment->app_date)->format('g:i A') }} - {{ $appointment->reason ?? trans('site.advisor.dashboard.course_advising') }}</div>
                                </div>
                            </div>
                            @empty
                            <div class="activity-item">
                                <p>{{trans('site.advisor.dashboard.no_appointments_today')}}</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="activity-card">
                            <h3><i class="fas fa-bolt mr-2"></i>{{trans('site.advisor.dashboard.quick_actions')}}</h3>
                            <div class="text-center mb-3">
                                <a href="{{ route('advisor.ticket') }}" class="btn btn-action btn-block">
                                    <i class="fas fa-ticket-alt mr-2"></i>{{trans('site.advisor.dashboard.view_tickets')}}
                                </a>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('advisor.appointment') }}" class="btn btn-action btn-block">
                                    <i class="fas fa-calendar-alt mr-2"></i>{{trans('site.advisor.dashboard.view_appointments')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
@endsection