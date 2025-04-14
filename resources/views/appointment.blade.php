@extends('layouts.AdviseMate')
@section('title', trans('site.appointments.title'))
@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/main.min.css">
<style>
    .fc-event {
        cursor: pointer;
    }
    .appointment-details {
        margin-top: 20px;
    }
    .badge-upcoming {
        background-color: #17a2b8;
        color: white;
    }
    .badge-completed {
        background-color: #28a745;
        color: white;
    }
    .badge-cancelled {
        background-color: #dc3545;
        color: white;
    }
    .badge-pending {
        background-color: #ffc107;
        color: #212529;
    }
</style>
@endsection

@section('content')
    <div class="container">
        <!-- Main Content -->
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <main class="col-12 col-md-9 col-lg-10 ml-auto px-3 py-4">

                    
                    <!-- Book New Appointment Card -->
                    <div class="card shadow-sm rounded mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-calendar-plus mr-2"></i> {{ trans('site.appointments.schedule_new') }}</h5>
                        </div>
                        <div class="card-body">
                            <div id="calendar"></div>
                            
                            <!-- Appointment Details (shown after selecting a time slot) -->
                            <div class="appointment-details d-none" id="appointmentDetails">
                                <div class="alert alert-info">
                                    <h5>Confirm Appointment</h5>
                                    <p>Date: <span id="selectedDate"></span></p>
                                    <p>Time: <span id="selectedTime"></span></p>
                                    
                                    <div class="d-flex justify-content-end mt-3">
                                        <button class="btn btn-secondary mr-2" id="cancelSelection">Cancel</button>
                                        <button class="btn btn-primary" id="confirmAppointment">Confirm Booking</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- My Appointments Card -->
                    <div class="card shadow-sm rounded">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0"><i class="fas fa-list mr-2"></i> My Appointments</h5>
                        </div>
                        <div class="card-body">
                            @if(isset($appointments) && count($appointments) > 0)
                                <ul class="list-group list-group-flush">
                                    @foreach($appointments as $appointment)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-0">Meeting with {{ $appointment->advisor->fName ?? $appointment->advisor->lName ?? 'Advisor' }}</h6>
                                                <small class="text-muted">{{ $appointment->app_date->format('F j, Y - g:i A') }}</small>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="badge badge-{{ $appointment->status == 'pending' ? 'pending' : ($appointment->status == 'accepted' ? 'upcoming' : ($appointment->status == 'completed' ? 'completed' : 'cancelled')) }} mr-2">
                                                    {{ ucfirst($appointment->status) }}
                                                </span>
                                                @if($appointment->status == 'pending' || $appointment->status == 'accepted')
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="alert alert-info">
                                    You don't have any appointments scheduled yet.
                                </div>
                            @endif
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
        let selectedAvailabilityId = null;
        
        // Initialize calendar
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'timeGridWeek,timeGridDay'
            },
            slotMinTime: '08:00:00',
            slotMaxTime: '18:00:00',
            allDaySlot: false,
            height: 'auto',
            eventClick: function(info) {
                // Show appointment details form
                document.getElementById('appointmentDetails').classList.remove('d-none');
                
                // Set selected time details
                document.getElementById('selectedDate').textContent = info.event.start.toLocaleDateString();
                document.getElementById('selectedTime').textContent = `${info.event.start.toLocaleTimeString()} - ${info.event.end.toLocaleTimeString()}`;
                
                // Store the availability ID
                selectedAvailabilityId = info.event.extendedProps.availabilityId;
            }
        });
        
        calendar.render();
        
        // Fetch advisor's available slots
        fetch('/student/get-availabilities', {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Received data:', data); // Debug output
            
            if (data.error) {
                alert(data.error);
                return;
            }
            
            // Add events directly since they're already properly formatted for FullCalendar
            calendar.addEventSource(data);
        })
        .catch(error => {
            console.error('Error fetching availabilities:', error);
            alert('Failed to load available appointments. Please try again later.');
        });
        
        // Cancel selection button
        document.getElementById('cancelSelection').addEventListener('click', function() {
            document.getElementById('appointmentDetails').classList.add('d-none');
            selectedAvailabilityId = null;
        });
        
        // Confirm appointment button
        document.getElementById('confirmAppointment').addEventListener('click', function() {
            if (!selectedAvailabilityId) {
                alert('No time slot selected');
                return;
            }
            
            fetch('/student/book-appointment', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    availability_id: selectedAvailabilityId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                    return;
                }
                
                // Show success and reload the page
                alert('Appointment booked successfully!');
                window.location.reload();
            })
            .catch(error => {
                console.error('Error booking appointment:', error);
                alert('Failed to book appointment. Please try again.');
            });
        });
        
        // Cancel appointment buttons
        document.querySelectorAll('.cancel-appointment').forEach(button => {
            button.addEventListener('click', function() {
                const appointmentId = this.getAttribute('data-id');
                
                if (confirm('Are you sure you want to cancel this appointment?')) {
                    fetch(`/student/cancel-appointment/${appointmentId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert(data.error);
                            return;
                        }
                        
                        // Show success and reload the page
                        alert('Appointment cancelled successfully!');
                        window.location.reload();
                    })
                    .catch(error => {
                        console.error('Error cancelling appointment:', error);
                        alert('Failed to cancel appointment. Please try again.');
                    });
                }
            });
        });
    });
</script>
@endsection