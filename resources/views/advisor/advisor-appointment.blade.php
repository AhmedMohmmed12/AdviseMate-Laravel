@extends('layouts.AdviseMateAdvisor')
@section('title','Appointment')
@section('content')

    

    
    <div class="main-content">
        <h1 class="header">{{trans('site.advisor.appointments.title')}}</h1>
        
        <div class="appointment-controls">
            <button class="action-button" id="addAvailability">
                <i class="fas fa-plus"></i> 
                {{trans('site.advisor.appointments.new_hours')}}
            </button>
        </div>

        <div class="calendar-card">
            <h2 class="card-title">
                <i class="fas fa-calendar-alt"></i> 
                {{trans('site.advisor.appointments.calendar')}}
            </h2>
            <div class="calendar" id="calendar">
                <!-- Interactive calendar integration would go here -->
                {{-- <p>Calendar integration (e.g., FullCalendar.js)</p> --}}
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
            slotMaxTime: '20:00:00',
            slotDuration: '00:15:00',
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
    });
</script>

<style>
    /* Add calendar styling */
    .fc {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .fc-event {
        cursor: pointer;
        padding: 3px 5px;
        border-radius: 4px;
    }
    
    .fc-daygrid-event-dot {
        display: none;
    }

    /* Add these styles for better toast notifications */
    .toast-success {
        background-color: #51A351 !important;
    }
    
    .toast-error {
        background-color: #BD362F !important;
    }
    
    .toast-info {
        background-color: #2F96B4 !important;
    }
    
    .toast-warning {
        background-color: #F89406 !important;
    }
</style>
@endsection