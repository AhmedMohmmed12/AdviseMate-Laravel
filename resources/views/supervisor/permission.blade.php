@extends('layouts.AdviseMateAdvisor')
@section('title','Advisor-Student Assignment')
@section('content')

        <style>
            .avatar-circle {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 32px;
                height: 32px;
                border-radius: 50%;
                font-size: 12px;
                font-weight: 600;
            }
            .badge-pill {
                font-weight: 500;
                font-size: 0.75rem;
            }
            .table th {
                font-weight: 600;
                color: #495057;
            }
            .font-weight-medium {
                font-weight: 500;
            }
        </style>
        
        <main class="col-12 col-md-9 col-lg-10 ml-auto px-3 py-4 content">
            
            <div class="advisor-student-container">
                <div class="advisor-student-header d-flex justify-content-between align-items-center mb-4">
                    <h3>Manage Advisor-Student Assignments</h3>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#assignStudentModal">
                        <i class="fas fa-link mr-2"></i>Assign Student to Advisor
                    </button>
                </div>
                
                <!-- Filter Form -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Filter Options</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('supervisor.permission') }}" method="GET">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="advisor_id">Advisor</label>
                                        <select id="advisor_id" name="advisor_id" class="form-control">
                                            <option value="">All Advisors</option>
                                            @foreach($advisors as $advisor)
                                                <option value="{{ $advisor->id }}" {{ request('advisor_id') == $advisor->id ? 'selected' : '' }}>
                                                    {{ $advisor->fName }} {{ $advisor->lName }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="program">Program</label>
                                        <select id="program" name="program" class="form-control">
                                            <option value="">All Programs</option>
                                            <option value="Computer Science" {{ request('program') == 'Computer Science' ? 'selected' : '' }}>Computer Science</option>
                                            <option value="Business" {{ request('program') == 'Business' ? 'selected' : '' }}>Business</option>
                                            <option value="Engineering" {{ request('program') == 'Engineering' ? 'selected' : '' }}>Engineering</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select id="status" name="status" class="form-control">
                                            <option value="">All Statuses</option>
                                            <option value="assigned" {{ request('status') == 'assigned' ? 'selected' : '' }}>Assigned</option>
                                            <option value="unassigned" {{ request('status') == 'unassigned' ? 'selected' : '' }}>Unassigned</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                                <a href="{{ route('supervisor.permission') }}" class="btn btn-secondary">Clear Filters</a>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Students Table -->
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Student Assignments</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-top-0">Student ID</th>
                                        <th class="border-top-0">Student Name</th>
                                        <th class="border-top-0">Program</th>
                                        <th class="border-top-0">Current Advisor</th>
                                        <th class="border-top-0">Status</th>
                                        <th class="border-top-0 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($students as $student)
                                        <tr>
                                            <td class="align-middle">#STU-{{ $student->id }}</td>
                                            <td class="align-middle font-weight-medium">{{ ucfirst($student->Fname) }} {{ ucfirst($student->LName) }}</td>
                                            <td class="align-middle">{{ $student->Program }}</td>
                                            <td class="align-middle">
                                                @if($student->advisor)
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-circle bg-primary text-white mr-2">
                                                            {{ substr(ucfirst($student->advisor->fName), 0, 1) }}{{ substr(ucfirst($student->advisor->lName), 0, 1) }}
                                                        </div>
                                                        <span>{{ ucfirst($student->advisor->fName) }} {{ ucfirst($student->advisor->lName) }}</span>
                                                    </div>
                                                @else
                                                    <span class="text-muted">Unassigned</span>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                @if($student->advisor)
                                                    <span class="badge badge-pill badge-success px-3 py-2">Assigned</span>
                                                @else
                                                    <span class="badge badge-pill badge-warning px-3 py-2">Unassigned</span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                @if($student->advisor)
                                                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill" data-toggle="modal" data-target="#unassignStudentModal{{ $student->id }}">
                                                        <i class="fas fa-unlink mr-1"></i> Unassign
                                                    </button>
                                                    
                                                    <!-- Unassign Modal for this student -->
                                                    <div class="modal fade" id="unassignStudentModal{{ $student->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Unassign Student</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action="{{ route('supervisor.unassign-student') }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                                                                    <div class="modal-body">
                                                                        <p>Are you sure you want to unassign this student from their current advisor?</p>
                                                                        <p><strong>Student: </strong>{{ ucfirst($student->Fname) }} {{ ucfirst($student->LName) }}</p>
                                                                        <p><strong>Current Advisor: </strong>{{ ucfirst($student->advisor->fName) }} {{ ucfirst($student->advisor->lName) }}</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                        <button type="submit" class="btn btn-danger">Unassign</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <button class="btn btn-sm btn-outline-secondary rounded-pill" disabled>
                                                        <i class="fas fa-user-slash mr-1"></i> Unassigned
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="fas fa-users text-muted mb-2" style="font-size: 2rem;"></i>
                                                    <p class="mb-0">No students found matching your criteria</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>

<!-- Assign Student Modal -->
<div class="modal fade" id="assignStudentModal" tabindex="-1" role="dialog" aria-labelledby="assignStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignStudentModalLabel">Assign Student to Advisor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('supervisor.assign-student') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="student_id">Select Student</label>
                                <select class="form-control" id="student_id" name="student_id" required>
                                    <option value="">-- Select Student --</option>
                                    @foreach($unassignedStudents as $student)
                                        <option value="{{ $student->id }}">
                                            {{ ucfirst($student->Fname) }} {{ ucfirst($student->LName) }} - #STU-{{ $student->id }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="advisor_id">Select Advisor</label>
                                <select class="form-control" id="advisor_id" name="advisor_id" required>
                                    <option value="">-- Select Advisor --</option>
                                    @foreach($advisors as $advisor)
                                        <option value="{{ $advisor->id }}">
                                            {{ $advisor->fName }} {{ $advisor->lName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Assign</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection