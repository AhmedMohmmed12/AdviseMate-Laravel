@extends('layouts.AdviseMateAdvisor')
@section('title','Appointment')
@section('styles')
<style>
    .nav-tabs .nav-item .nav-link {
        color: #495057;
    }
    .nav-tabs .nav-item .nav-link.active {
        font-weight: bold;
        color: #007bff;
    }
</style>
@endsection
@section('content')

<div class="container">
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <main class="col-12 col-md-9 col-lg-10 ml-auto px-3 py-4">
                <!-- Calendar Card -->
                <div class="card shadow-sm rounded mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-calendar-alt mr-2"></i> {{ trans('site.advisor.appointments.calendar') }}</h5>
                    </div>
                    <div class="card-body">
                        <div id="calendar"></div>
                        <div class="calendar-legend mt-3 d-flex flex-wrap justify-content-center">
                            <div class="legend-item mx-2 mb-2 d-flex align-items-center">
                                <span class="legend-color" style="background-color: #4CAF50;"></span>
                                <span class="legend-text">Available Slots</span>
                            </div>
                            <div class="legend-item mx-2 mb-2 d-flex align-items-center">
                                <span class="legend-color" style="background-color: #FFC107;"></span>
                                <span class="legend-text">Pending Appointments</span>
                            </div>
                            <div class="legend-item mx-2 mb-2 d-flex align-items-center">
                                <span class="legend-color" style="background-color: #2196F3;"></span>
                                <span class="legend-text">Accepted Appointments</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Appointments Card -->
                <div class="card shadow-sm rounded">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0"><i class="fas fa-list mr-2"></i> My Appointments</h5>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs mb-3" id="appointmentTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="current-tab" data-toggle="tab" href="#current" role="tab">
                                    Current Appointments
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="history-tab" data-toggle="tab" href="#history" role="tab">
                                    <i class="fas fa-history mr-1"></i> History (30+ Days)
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="appointmentTabContent">
                            <!-- Current Appointments Tab -->
                            <div class="tab-pane fade show active" id="current" role="tabpanel">
                                @if((isset($pendingAppointments) && count($pendingAppointments) > 0) || (isset($upcomingAppointments) && count($upcomingAppointments) > 0))
                                    <ul class="list-group list-group-flush mb-3">
                                        @if(isset($pendingAppointments) && count($pendingAppointments) > 0)
                                            @foreach($pendingAppointments as $appointment)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h6 class="mb-0">Meeting with {{ ucfirst($appointment->student->Fname) }} {{ ucfirst($appointment->student->LName) }}</h6>
                                                        <small class="text-muted">{{ $appointment->app_date->format('F j, Y - g:i A') }}</small>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge badge-warning mr-2">Pending</span>
                                                        <button class="btn btn-success btn-sm mr-1 btn-approve" data-id="{{ $appointment->id }}"><i class="fas fa-check"></i></button>
                                                        <button class="btn btn-danger btn-sm btn-reject" data-id="{{ $appointment->id }}"><i class="fas fa-times"></i></button>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif
                                        @if(isset($upcomingAppointments) && count($upcomingAppointments) > 0)
                                            @foreach($upcomingAppointments as $appointment)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h6 class="mb-0">Meeting with {{ ucfirst($appointment->student->Fname) }} {{ ucfirst($appointment->student->LName) }}</h6>
                                                        <small class="text-muted">{{ $appointment->app_date->format('F j, Y - g:i A') }}</small>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge badge-success mr-2">Accepted</span>
                                                        <button class="btn btn-primary btn-sm btn-contact" onclick="window.location.href='mailto:{{ $appointment->student->email }}'"><i class="fas fa-envelope"></i></button>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                @else
                                    <div class="alert alert-info">
                                        You don't have any upcoming appointments.
                                    </div>
                                @endif
                            </div>
                            <!-- Historical Appointments Tab -->
                            <div class="tab-pane fade" id="history" role="tabpanel">
                                @if(isset($archivedAppointments) && count($archivedAppointments) > 0)
                                    <ul class="list-group list-group-flush">
                                        @foreach($archivedAppointments as $appointment)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="mb-0">Meeting with {{ ucfirst($appointment->student->Fname) }} {{ ucfirst($appointment->student->LName) }}</h6>
                                                    <small class="text-muted">{{ $appointment->app_date->format('F j, Y - g:i A') }}</small>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span class="badge badge-{{ $appointment->status == 'accepted' ? 'success' : ($appointment->status == 'rejected' ? 'danger' : 'warning') }} mr-2">
                                                        {{ ucfirst($appointment->status) }}
                                                    </span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="alert alert-info">
                                        You don't have any historical appointments.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>

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
            initialDate: new Date(),
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            validRange: {
                start: new Date()
            },  
            hiddenDays: [5, 6], // Hide Friday and Saturday
            businessHours: {
                daysOfWeek: [0, 1, 2, 3, 4], // Sunday to Thursday
                startTime: '08:00',
                endTime: '16:00',
            },
            slotMinTime: '08:00:00',
            slotMaxTime: '16:00:00',
            slotDuration: '01:00:00',
            height: 500,
            expandRows: true,
            stickyHeaderDates: true,
            nowIndicator: true,
            allDaySlot: false,
            slotLabelFormat: {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true,
            },
            eventSources: [
                {
                    // Availability slots
                    url: "{{ route('advisor.availability.fetch') }}",
                    method: 'GET',
                    color: '#4CAF50',
                    failure: function() {
                        toastr.error('Failed to load availability slots');
                    }
                },
                {
                    // Existing appointments
                    url: "{{ route('advisor.get-appointments') }}",
                    method: 'GET',
                    color: '#2196F3',
                    failure: function() {
                        toastr.error('Failed to load appointments');
                    }
                }
            ],
            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            },
            selectable: true,
            select: function(info) {
                // Check if the selected start time is in the past
                const now = new Date();
                const selectedStart = new Date(info.startStr);
                
                if (selectedStart < now) {
                    toastr.error('Cannot create availability slots in the past');
                    return;
                }
                
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
                // Only allow dragging availability slots (not appointments)
                if (info.event.source.id === '0') { // First source is availability
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
                } else {
                    info.revert();
                    toastr.error('Cannot drag appointments, only availability slots');
                }
            },
            eventResize: function(info) {
                // Only allow resizing availability slots (not appointments)
                if (info.event.source.id === '0') { // First source is availability
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
                } else {
                    info.revert();
                    toastr.error('Cannot resize appointments, only availability slots');
                }
            },
            eventClick: function(info) {
                // Check if this is an availability slot or an appointment
                if (info.event.id.toString().startsWith('appt_')) {
                    // This is an appointment
                    const studentName = info.event.extendedProps.studentName || 'Unknown';
                    const status = info.event.extendedProps.status || 'Unknown';
                    toastr.info(`Appointment with ${studentName}<br>Status: ${status}`);
                } else {
                    // This is an availability slot
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
                }
            },
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
    
    .calendar-legend {
        padding-top: 10px;
        border-top: 1px solid #eee;
    }
    
    .legend-item {
        font-size: 0.9rem;
        margin-right: 15px;
    }
    
    .legend-color {
        display: inline-block;
        width: 15px;
        height: 15px;
        border-radius: 3px;
        margin-right: 5px;
    }
    
    .legend-text {
        color: #555;
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