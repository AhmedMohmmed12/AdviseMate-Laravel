@extends('layouts.AdviseMate')
@section('title', 'Tickets')
@section('content')

    

            <main class="col-12 col-md-9 col-lg-10 ml-auto px-3 py-4">
                <div class="mt-4 mb-3">
                    <h2>{{trans('site.tickets.title')}}</h2>
                </div>
                <div class="card shadow-sm rounded">
                    <div class="card-body">
                        <select id="ticket-type" class="form-control select2">
                            <option value="" disabled selected>Select Ticket Type</option>
                            <i class="fas fa-plus mr-2"></i> {{trans('site.tickets.create_new')}}
                        </select>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{trans('site.dashboard.registration_issue')}}
                                <span class="badge badge-open">{{trans('site.status.open')}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{trans('site.dashboard.course_deletion')}}
                                <span class="badge badge-closed">{{trans('site.status.closed')}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{trans('site.tickets.financial_aid')}}
                                <span class="badge badge-open">{{trans('site.status.open')}}</span>
                            </li>
                        </ul>
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
                    } else {
                        $('#extra-field').hide();
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
        });
    </script>
@endsection