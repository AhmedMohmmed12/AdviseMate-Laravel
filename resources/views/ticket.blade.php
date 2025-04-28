@extends('layouts.AdviseMate')
@section('title', 'Tickets')
@section('content')

            <main class="col-12 col-md-9 col-lg-10 ml-auto px-3 py-4">
                <div class="mt-4 mb-3">
                    <h2>Tickets</h2>
                </div>
                <div class="card shadow-sm rounded mb-4">
                    <div class="card-body">
                        <select id="ticket-type" class="form-control select2">
                            <option value="" disabled selected>Select Ticket Type</option>
                        </select>
                    </div>
                </div>
                
                <!-- Student's Tickets Section -->
                <div class="card shadow-sm rounded">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">My Tickets</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($studentTickets) && count($studentTickets) > 0)
                                        @foreach($studentTickets as $ticket)
                                            <tr>
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
                                                        @if($ticket->ticket_status == 'pending')
                                                            Pending
                                                        @elseif($ticket->ticket_status == 'completed')
                                                            Completed
                                                        @else
                                                            Rejected
                                                        @endif
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center">No tickets found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>

    <!-- Ticket Modal -->
    <div class="modal fade" id="ticket-modal" tabindex="-1" role="dialog" aria-labelledby="ticketModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content shadow-lg rounded-lg">
                <!-- Modal Header -->
                <div class="modal-header" style="background-color: #ddad27;">
                    <h5 class="modal-title font-weight-bold text-white" id="modal-title">
                        <i class="fas fa-ticket-alt"></i> New Ticket
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body" style="background-color: #fff;">
                    <form id="ticket-form">
                        <div class="row">
                            <!-- Ticket Type -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label font-weight-bold" style="color: #2c3e50;">
                                        <i class="fas fa-tag" style="color: #ddad27;"></i> Ticket Type
                                    </label>
                                    <input type="text" id="ticket-name" name="ticket-name" class="form-control rounded" style="border-color: #ddad27;" readonly>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label font-weight-bold" style="color: #2c3e50;">
                                        <i class="fas fa-comment" style="color: #ddad27;"></i> Description
                                    </label>
                                    <textarea id="description" name="description" class="form-control rounded" style="border-color: #ddad27;" rows="4" required></textarea>
                                </div>
                            </div>

                            <!-- File Upload -->
                            <div class="col-md-12">
                                <div class="form-group" id="extra-field" style="display: none;">
                                    <label class="form-label font-weight-bold" style="color: #2c3e50;">
                                        <i class="fas fa-file-pdf" style="color: #ddad27;"></i> Attach PDF
                                    </label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="extra-input" name="extra-input" accept="application/pdf">
                                        <label class="custom-file-label" for="extra-input" style="border-color: #ddad27;">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn px-4 py-2 shadow-sm rounded" style="background-color: #ddad27; color: white;">
                                <i class="fas fa-paper-plane"></i> Submit Ticket
                            </button>
                            <button type="button" class="btn btn-secondary px-4 py-2 shadow-sm rounded ml-2" data-dismiss="modal">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function () {
            $('#ticket-type').select2({
                ajax: {
                    url: '/student/get-ticket-types',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: data.map(function (ticket) {
                                return { id: ticket.id, text: ticket.ticket_type };
                            })
                        };
                    }
                }
            });

            $('#ticket-type').on('change', function () {
                var selectedId = parseInt($(this).val());
                var selectedText = $("#ticket-type option:selected").text();
                
                if (selectedText !== "Select Ticket Type") {
                    $('#modal-title').text('New Ticket - ' + selectedText);
                    $('#ticket-name').val(selectedText);
                    
                    if (selectedId >= 4 && selectedId <= 7) {
                        $('#extra-field').show();
                        $('#extra-input').prop('required', true);
                    } else {
                        $('#extra-field').hide();
                        $('#extra-input').prop('required', false);
                    }
                    
                    $('#ticket-modal').modal('show');
                }
            });

            // Update file input label with selected filename
            $('.custom-file-input').on('change', function() {
                var fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').html(fileName);
            });

            // Handle modal close
            $('#ticket-modal').on('hidden.bs.modal', function () {
                $('#ticket-type').val(null).trigger('change');
                $('#ticket-form')[0].reset();
                $('.custom-file-label').html('Choose file');
            });
            
            // Form submission with Axios
            $('#ticket-form').on('submit', function(e) {
                e.preventDefault();
                
                var formData = new FormData();
                formData.append('ticket_type_id', $('#ticket-type').val());
                formData.append('ticket_description', $('#description').val());
                
                if ($('#extra-field').is(':visible') && $('#extra-input')[0].files[0]) {
                    formData.append('file', $('#extra-input')[0].files[0]);
                }
                
                axios.post('{{ route("student.ticket.create") }}', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(function(response) {
                    $('#ticket-modal').modal('hide');
                    // Show success message
                    toastr.success(response.data.message);
                    // Delay reload for 1 second to show the notification
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                })
                .catch(function(error) {
                    console.error('Error:', error);
                    let errorMsg = 'An error occurred';
                    
                    if (error.response && error.response.data && error.response.data.errors) {
                        errorMsg = '';
                        const errors = error.response.data.errors;
                        
                        for (const key in errors) {
                            errorMsg += errors[key][0] + '\n';
                        }
                    } else if (error.response && error.response.data && error.response.data.message) {
                        errorMsg = error.response.data.message;
                    }
                    
                    toastr.error('Error: ' + errorMsg);
                });
            });
        });
    </script>
@endsection