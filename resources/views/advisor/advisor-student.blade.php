@extends('layouts.AdviseMateAdvisor')
@section('title','Students')
@section('content')

            <main class="col-12 col-md-9 col-lg-10 ml-auto px-3 py-4 content">
                <div class="mt-4 mb-4">
                    <h2>{{trans('site.advisor.students.title')}}</h2>
                </div>
                
                <div class="student-filter">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" id="searchInput" placeholder="{{trans('site.advisor.students.search')}}">
                                <div class="input-group-append">
                                    <button class="btn btn-warning" type="button" id="searchButton">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 ml-auto">
                            <select class="form-control" id="programFilter">
                                <option value="">{{trans('site.advisor.students.filters.all_programs')}}</option>
                                <option value="computer_science">{{trans('site.advisor.students.filters.computer_science')}}</option>
                                <option value="business">{{trans('site.advisor.students.filters.business')}}</option>
                                <option value="engineering">{{trans('site.advisor.students.filters.engineering')}}</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" id="statusFilter">
                                <option value="">{{trans('site.advisor.students.filters.all_statuses')}}</option>
                                <option value="active">{{trans('site.advisor.students.filters.active')}}</option>
                                <option value="probation">{{trans('site.advisor.students.filters.probation')}}</option>
                                <option value="graduated">{{trans('site.advisor.students.filters.graduated')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="student-table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{trans('site.advisor.students.table.name')}}</th>
                                <th>{{trans('site.advisor.students.table.id')}}</th>
                                <th>{{trans('site.advisor.students.table.program')}}</th>
                                <th>{{trans('site.advisor.students.table.status')}}</th>
                                <th>{{trans('site.advisor.students.table.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody id="studentsTableBody">
                            @foreach($assignedStudents as $student)
                            <tr>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar">{{ substr($student->Fname, 0, 1) }}{{ substr($student->LName, 0, 1) }}</div>
                                        <div>
                                            <div>{{ ucfirst($student->Fname) }} {{ ucfirst($student->LName) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>#STU-{{ $student->id }}</td>
                                <td>{{ $student->program ?? trans('site.advisor.students.filters.computer_science') }}</td>
                                <td>
                                    <span class="badge bg-{{ $student->status == 'active'?'success':'danger'}}">
                                        {{ trans('site.advisor.students.filters.' . $student->status) }}
                                    </span>
                                </td>
                                <td class="action-icons">
                                    <a href="https://wa.me/{{ $student->phoneNumber }}" target="_blank" title="{{trans('site.advisor.students.view_profile')}}"><i class="fab fa-whatsapp"></i></a>
                                    <a href="mailto:{{ $student->email }}" title="{{trans('site.advisor.students.send_message')}}"><i class="fas fa-envelope"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </main>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const programFilter = document.getElementById('programFilter');
        const statusFilter = document.getElementById('statusFilter');
        const studentsTableBody = document.getElementById('studentsTableBody');
        const rows = studentsTableBody.getElementsByTagName('tr');

        function filterStudents() {
            const searchTerm = searchInput.value.toLowerCase();
            const programValue = programFilter.value;
            const statusValue = statusFilter.value;

            Array.from(rows).forEach(row => {
                const name = row.querySelector('.student-info div:first-child').textContent.toLowerCase();
                const program = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                const status = row.querySelector('td:nth-child(4) span').className.replace('status-', '');

                const matchesSearch = name.includes(searchTerm);
                const matchesProgram = !programValue || program.includes(programValue);
                const matchesStatus = !statusValue || status === statusValue;

                row.style.display = matchesSearch && matchesProgram && matchesStatus ? '' : 'none';
            });
        }

        searchInput.addEventListener('input', filterStudents);
        programFilter.addEventListener('change', filterStudents);
        statusFilter.addEventListener('change', filterStudents);
    });
</script>
@endpush
@endsection