@extends('layouts.AdviseMateAdvisor')
@section('title','Ticket')
@section('content')

        <main class="col-12 col-md-9 col-lg-10 ml-auto px-3 py-4 content">
            <div class="mt-4 mb-4">
                <h2>{{trans('site.advisor.tickets.title')}}</h2>
            </div>
            
            <div class="ticket-filter mb-3">
                <div class="row">
                    <div class="col-md-3">
                        <select class="form-control" id="status-filter">
                            <option value="all">{{trans('site.advisor.tickets.filters.all')}}</option>
                            <option value="pending">{{trans('site.advisor.tickets.filters.pending')}}</option>
                            <option value="completed">{{trans('site.advisor.tickets.filters.completed')}}</option>
                            <option value="rejected">{{trans('site.advisor.tickets.filters.rejected')}}</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="ticket-table">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>{{trans('site.advisor.tickets.table.student')}}</th>
                            <th>{{trans('site.advisor.tickets.table.issue')}}</th>
                            <th>{{trans('site.advisor.tickets.table.description')}}</th>
                            <th>{{trans('site.advisor.tickets.table.date')}}</th>
                            <th>{{trans('site.advisor.tickets.table.status')}}</th>
                            <th>{{trans('site.advisor.tickets.table.actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($tickets) && count($tickets) > 0)
                            @foreach($tickets as $ticket)
                                <tr class="ticket-row" data-status="{{ $ticket->ticket_status }}">
                                    <td>
                                        @if($ticket->student)
                                            {{ ucfirst($ticket->student->Fname ?? '') }} {{ ucfirst($ticket->student->LName ?? '') }}
                                        @else
                                            Unknown Student
                                        @endif
                                    </td>
                                    <td>
                                        @if($ticket->ticketType)
                                            {{ $ticket->ticketType->ticket_type }}
                                        @else
                                            Unknown Type
                                        @endif
                                    </td>
                                    <td>{{ Str::limit($ticket->ticket_description, 50) }}</td>
                                    <td>{{ $ticket->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($ticket->ticket_status == 'pending') badge-warning
                                            @elseif($ticket->ticket_status == 'completed') badge-success
                                            @else badge-danger @endif">
                                            {{ ucfirst($ticket->ticket_status) }}
                                        </span>
                                    </td>
                                    <td class="action-icons">
                                        <button class="btn btn-sm btn-success update-status" 
                                            data-ticket-id="{{ $ticket->id }}" 
                                            data-status="completed" 
                                            @if($ticket->ticket_status == 'completed') disabled @endif>
                                            <i class="fas fa-check-circle"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger update-status" 
                                            data-ticket-id="{{ $ticket->id }}" 
                                            data-status="rejected" 
                                            @if($ticket->ticket_status == 'rejected') disabled @endif>
                                            <i class="fas fa-times-circle"></i>
                                        </button>
                                        @if($ticket->file)
                                            <a href="{{ asset('uploads/' . $ticket->file) }}" 
                                               target="_blank" 
                                               class="btn btn-sm btn-info">
                                                <i class="fas fa-file-pdf"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">No tickets found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </main>

<script>
    $(document).ready(function() {
        // Filter tickets by status
        $('#status-filter').on('change', function() {
            var status = $(this).val();
            
            if (status === 'all') {
                $('.ticket-row').show();
            } else {
                $('.ticket-row').hide();
                $('.ticket-row[data-status="' + status + '"]').show();
            }
        });
        
        // Update ticket status using Axios
        $('.update-status').on('click', function() {
            var ticketId = $(this).data('ticket-id');
            var newStatus = $(this).data('status');
            var row = $(this).closest('tr');
            
            if (!ticketId) {
                toastr.error('Error: Ticket ID not found');
                return;
            }
            
            axios.post('{{ route("advisor.ticket.update-status", ["id" => ":id"]) }}'.replace(':id', ticketId), {
                ticket_status: newStatus
            }, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(function(response) {
                console.log('Success:', response.data);
                // Update UI to reflect the new status
                var badgeClass = newStatus === 'completed' ? 'badge-success' : 'badge-danger';
                row.find('.badge')
                   .removeClass('badge-warning badge-success badge-danger')
                   .addClass(badgeClass)
                   .text(newStatus.charAt(0).toUpperCase() + newStatus.slice(1));
                
                // Disable the clicked button and enable the other one
                row.find('.update-status[data-status="' + newStatus + '"]').prop('disabled', true);
                row.find('.update-status:not([data-status="' + newStatus + '"])').prop('disabled', false);
                
                // Update row data attribute
                row.attr('data-status', newStatus);
                
                toastr.success(response.data.message);
            })
            .catch(function(error) {
                console.error('Error:', error);
                let errorMsg = 'An error occurred';
                
                if (error.response && error.response.data && error.response.data.message) {
                    errorMsg = error.response.data.message;
                }
                
                toastr.error('Error updating ticket status: ' + errorMsg);
            });
        });
    });
</script>

@endsection