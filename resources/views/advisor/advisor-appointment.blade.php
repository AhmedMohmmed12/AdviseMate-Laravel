@extends('layouts.AdviseMateAdvisor')
@section('title','Appointment')
@section('content')


<main class="col-12 col-md-9 col-lg-10 ml-auto px-3 py-4 content">



    <div class="calendar-card">
        <h2 class="card-title mb-4">
            <i class="fas fa-calendar-alt"></i> 
            {{trans('site.advisor.appointments.calendar')}}
        </h2>
        <div class="calendar-container">
            <div class="calendar" id="calendar"></div>
        </div>
    </div>

    <div class="appointment-list mt-4">
        <h2>
            <i class="fas fa-list"></i> 
            {{trans('site.advisor.appointments.upcoming')}}
        </h2>
        
        @if(isset($pendingAppointments) && count($pendingAppointments) > 0)
            <h4 class="mt-4 mb-3">Pending Requests</h4>
            @foreach($pendingAppointments as $appointment)
                <div class="appointment-item pending">
                    <div class="appointment-status">
                        <span class="badge badge-warning">Pending</span>
                    </div>
                    <div class="appointment-info">
                        <strong>{{ ucfirst($appointment->student->Fname) }} {{ ucfirst($appointment->student->LName) }}</strong>
                        <p>{{ $appointment->app_date->format('F j, Y - g:i A') }}</p>
                    </div>
                    <div class="appointment-actions">
                        <button class="btn-approve" data-id="{{ $appointment->id }}">
                            <i class="fas fa-check"></i>
                            {{trans('site.advisor.appointments.approve')}}
                        </button>
                        <button class="btn-reject" data-id="{{ $appointment->id }}">
                            <i class="fas fa-times"></i>
                            {{trans('site.advisor.appointments.reject')}}
                        </button>
                    </div>
                </div>
            @endforeach
        @endif
        
        @if(isset($upcomingAppointments) && count($upcomingAppointments) > 0)
            <h4 class="mt-4 mb-3">Upcoming Appointments</h4>
            @foreach($upcomingAppointments as $appointment)
                <div class="appointment-item accepted">
                    <div class="appointment-status">
                        <span class="badge badge-success">Accepted</span>
                    </div>
                    <div class="appointment-info">
                        <strong>{{ ucfirst($appointment->student->Fname) }} {{ ucfirst($appointment->student->LName) }}</strong>
                        <p>{{ $appointment->app_date->format('F j, Y - g:i A') }}</p>
                    </div>
                    <div class="appointment-actions">
                        <button class="btn-contact" onclick="window.location.href='mailto:{{ $appointment->student->email }}'">
                            <i class="fas fa-envelope"></i>
                            Contact
                        </button>
                    </div>
                </div>
            @endforeach
        @endif
        
        @if((!isset($pendingAppointments) || count($pendingAppointments) == 0) && (!isset($upcomingAppointments) || count($upcomingAppointments) == 0))
            <div class="no-appointments">
                <p>You don't have any upcoming appointments.</p>
            </div>
        @endif
    </div>
</main>


<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios@1.6.7/dist/axios.min.js"></script>
<script>
    
    document.addEventListener('DOMContentLoaded', function() {
        // Configure toastr options
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            timeZone: '{{ config('app.timezone') }}',
            slotMinTime: '08:00:00',
            slotMaxTime: '16:00:00',
            slotDuration: '01:00:00',
            height: 'auto',
            expandRows: true,
            stickyHeaderDates: true,
            nowIndicator: true,
            hiddenDays: [5, 6], // Hide Friday and Saturday
            businessHours: {
                daysOfWeek: [0, 1, 2, 3, 4], // Sunday to Thursday
                startTime: '08:00',
                endTime: '16:00',
            },
            // Restrict selectable range to business days
            selectConstraint: {
                daysOfWeek: [0, 1, 2, 3, 4] // Sunday to Thursday
            },
            // Restrict event dragging to business days
            eventConstraint: {
                daysOfWeek: [0, 1, 2, 3, 4] // Sunday to Thursday
            },
            events: {
                url: "{{ route('advisor.availability.fetch') }}",
                method: 'GET',
                failure: function() {
                    toastr.error('Failed to load availability slots');
                }
            },
            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            },
            editable: true,
            selectable: true,
            select: function(info) {
                if (confirm('Create availability from ' + info.startStr + ' to ' + info.endStr + '?')) {
                    axios.post("{{ route('advisor.availability.store') }}", {
                        start_time: info.startStr,
                        end_time: info.endStr
                    })
                    .then(response => {
                        calendar.refetchEvents();
                        toastr.success('New availability slot has been added');
                    })
                    .catch(error => {
                        toastr.error(error.response?.data?.message || 'Failed to add availability slot');
                    });
                }
            },
            eventDrop: function(info) {
                axios.put(`/advisor/availability/${info.event.id}`, {
                    start_time: info.event.startStr,
                    end_time: info.event.endStr
                })
                .then(() => {
                    toastr.success('Availability slot has been updated');
                })
                .catch(error => {
                    info.revert();
                    toastr.error(error.response?.data?.message || 'Failed to update availability slot');
                });
            },
            eventResize: function(info) {
                axios.put(`/advisor/availability/${info.event.id}`, {
                    start_time: info.event.startStr,
                    end_time: info.event.endStr
                })
                .then(() => {
                    toastr.success('Availability duration has been updated');
                })
                .catch(error => {
                    info.revert();
                    toastr.error(error.response?.data?.message || 'Failed to update availability duration');
                });
            },
            eventClick: function(info) {
                if (confirm('Are you sure you want to delete this availability slot?')) {
                    axios.post(`/advisor/availability/${info.event.id}`)
                        .then(() => {
                            info.event.remove();
                            toastr.warning('Availability slot has been deleted');
                        })
                        .catch(error => {
                            toastr.error(error.response?.data?.message || 'Failed to delete availability slot');
                        });
                }
            },
            eventColor: '#4CAF50',
        });
        calendar.render();

        // Handle window resize
        window.addEventListener('resize', function() {
            calendar.updateSize();
        });

        // Add event listeners for approve buttons
        document.querySelectorAll('.btn-approve').forEach(function(button) {
            button.addEventListener('click', function() {
                const appointmentId = this.getAttribute('data-id');
                updateAppointmentStatus(appointmentId, 'accepted');
            });
        });
        
        // Add event listeners for reject buttons
        document.querySelectorAll('.btn-reject').forEach(function(button) {
            button.addEventListener('click', function() {
                const appointmentId = this.getAttribute('data-id');
                if (confirm('Are you sure you want to reject this appointment?')) {
                    updateAppointmentStatus(appointmentId, 'rejected');
                }
            });
        });
        
        // Function to update appointment status
        function updateAppointmentStatus(appointmentId, status) {
            axios.post(`/advisor/appointment-status/${appointmentId}`, {
                status: status,
                _token: '{{ csrf_token() }}'
            })
            .then(function(response) {
                toastr.success(`Appointment ${status === 'accepted' ? 'approved' : 'rejected'} successfully`);
                
                // Reload the page to show updated data
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            })
            .catch(function(error) {
                const errorMessage = error.response?.data?.error || 'Failed to update appointment status';
                toastr.error(errorMessage);
                console.error('Error:', error);
            });
        }
    });
</script>

<style>
    .calendar-container {
        margin: 0 auto;
        max-width: 1200px;
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .calendar {
        min-height: 600px;
    }

    /* FullCalendar Customization */
    .fc {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
    }

    .fc .fc-toolbar {
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1.5rem !important;
    }

    .fc .fc-toolbar-title {
        font-size: 1.5rem;
        font-weight: 600;
    }

    .fc .fc-button {
        padding: 0.5rem 1rem;
        font-weight: 500;
        border-radius: 6px;
        transition: all 0.2s ease;
    }

    .fc .fc-button-primary {
        background-color: #4CAF50;
        border-color: #4CAF50;
    }

    .fc .fc-button-primary:hover {
        background-color: #45a049;
        border-color: #45a049;
    }

    .fc .fc-event {
        background-color: #4CAF50;
        border: none;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 0.9rem;
        cursor: pointer;
        transition: transform 0.2s ease;
    }

    .fc .fc-event:hover {
        transform: scale(1.02);
    }

    .fc .fc-timegrid-slot {
        height: 3rem;
    }

    .fc .fc-day-today {
        background-color: rgba(76, 175, 80, 0.1) !important;
    }

    .fc .fc-timegrid-now-indicator-line {
        border-color: #e74c3c;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .calendar-container {
            padding: 10px;
        }

        .fc .fc-toolbar {
            justify-content: center;
        }

        .fc .fc-toolbar-title {
            font-size: 1.2rem;
        }

        .fc .fc-button {
            padding: 0.4rem 0.8rem;
            font-size: 0.9rem;
        }
    }

    /* Toast notifications */
    .toast-success {
        background-color: #4CAF50 !important;
    }
    
    .toast-error {
        background-color: #e74c3c !important;
    }
    
    .toast-info {
        background-color: #3498db !important;
    }
    
    .toast-warning {
        background-color: #f1c40f !important;
    }

    /* Action buttons */
    .action-button {
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        border-radius: 6px;
        transition: all 0.2s ease;
    }

    .btn-approve, .btn-reject, .btn-contact {
        padding: 0.5rem 1rem;
        border-radius: 6px;
        border: none;
        margin: 0.25rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-approve {
        background-color: #4CAF50;
        color: white;
    }

    .btn-reject {
        background-color: #F44336;
        color: white;
    }

    .btn-contact {
        background-color: #2196F3;
        color: white;
    }

    .btn-approve:hover, .btn-reject:hover, .btn-contact:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .appointment-list {
        margin-bottom: 30px;
    }
    
    .appointment-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: white;
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 12px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease;
    }
    
    .appointment-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .appointment-item.pending {
        border-left: 4px solid #FFC107;
    }
    
    .appointment-item.accepted {
        border-left: 4px solid #4CAF50;
    }
    
    .appointment-info {
        flex: 1;
    }
    
    .appointment-info strong {
        display: block;
        font-size: 16px;
        color: #333;
        margin-bottom: 4px;
    }
    
    .appointment-info p {
        color: #666;
        margin: 0;
    }
    
    .appointment-status {
        margin-right: 15px;
    }
    
    .badge {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 30px;
        font-weight: 500;
        font-size: 12px;
    }
    
    .badge-warning {
        background-color: #FFC107;
        color: #212529;
    }
    
    .badge-success {
        background-color: #4CAF50;
        color: white;
    }
    
    .appointment-actions {
        display: flex;
        gap: 8px;
    }
    
    .btn-approve i, .btn-reject i, .btn-contact i {
        margin-right: 6px;
    }
    
    .no-appointments {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        color: #6c757d;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .appointment-item {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .appointment-status, .appointment-info, .appointment-actions {
            width: 100%;
            margin-bottom: 10px;
        }
        
        .appointment-actions {
            justify-content: flex-start;
        }
    }
</style>
@endsection