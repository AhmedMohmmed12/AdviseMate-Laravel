@extends('layouts.AdviseMate')
@section('title', 'Dashboard')
@section('content')
<main class="col-12 col-md-9 col-lg-10 px-3 py-4 content">
    <div class="mt-4 mb-4">
        <h2>Welcome Back, {{ ucfirst(Auth::guard('student')->user()->Fname) }}!</h2>
    </div>
    
    <!-- Stats Row -->
    <div class="row">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <h3>Upcoming Appointments</h3>
                <div class="number">{{ $upcomingAppointments }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-ticket-alt"></i>
                </div>
                <h3>Active Tickets</h3>
                <div class="number">{{ $activeTickets }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h3>My Advisor</h3>
                <div class="advisor-info">
                    @if($advisor)
                        <strong>{{ ucfirst($advisor->fName ?? '') }} {{ ucfirst($advisor->lName ?? '') }}</strong>
                        <div class="text-muted d-flex align-items-center justify-content-center">
                            <a href="mailto:{{ $advisor->email ?? '' }}" class="text-muted mr-3" title="Email">
                                <i class="fas fa-envelope"></i>
                            </a>
                            {{ $advisor->email ?? '' }}
                        </div>
                        <div class="text-muted d-flex align-items-center justify-content-center">
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $advisor->mobileNumber ?? '') }}" class="text-muted mr-3" target="_blank" title="WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            {{ $advisor->mobileNumber ?? '' }}
                        </div>
                    @else
                        <span class="text-muted">No advisor assigned</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Activity Row -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="activity-card">
                <h3><i class="fas fa-calendar-alt mr-2"></i>Upcoming Appointments</h3>
                @if(count($recentAppointments) > 0)
                    @foreach($recentAppointments as $appointment)
                    <div class="activity-item">
                        <div>
                            <strong>{{ $appointment->advisor->fName ?? 'Advisor' }} Meeting</strong>
                            <div>{{ \Carbon\Carbon::parse($appointment->app_date)->format('l g:i A') }}</div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="activity-item">
                        <div>No upcoming appointments</div>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="activity-card">
                <h3><i class="fas fa-ticket-alt mr-2"></i>Recent Tickets</h3>
                @if(count($recentTickets) > 0)
                    @foreach($recentTickets as $ticket)
                    <div class="activity-item">
                        <div class="d-flex justify-content-between">
                            <div>
                                <strong>{{ $ticket->ticketType->ticket_type ?? 'Ticket' }}</strong>
                            </div>
                            <span class="badge badge-{{ $ticket->ticket_status == 'pending' ? 'warning' : ($ticket->ticket_status == 'completed' ? 'success' : 'danger') }}">
                                {{ ucfirst($ticket->ticket_status) }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="activity-item">
                        <div>No recent tickets</div>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="activity-card">
                <h3><i class="fas fa-bolt mr-2"></i>Quick Actions</h3>
                <div class="text-center mb-3">
                    <a href="{{ route('student.ticket') }}" class="btn btn-action btn-block">
                        <i class="fas fa-ticket-alt mr-2"></i>Create New Ticket
                    </a>
                </div>
                <div class="text-center">
                    <a href="{{ route('student.appointment') }}" class="btn btn-action btn-block">
                        <i class="fas fa-calendar-plus mr-2"></i>Schedule Meeting
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection