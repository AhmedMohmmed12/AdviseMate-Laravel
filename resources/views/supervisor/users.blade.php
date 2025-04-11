@extends('layouts.AdviseMateAdvisor')
@section('title','Users Management')
@section('content')


        <main class="col-12 col-md-9 col-lg-10 ml-auto px-3 py-4 content">
            <div class="mt-4 mb-4">
                <h2>{{ __('site.supervisor.users.title') }}</h2>
            </div>

            <div class="user-management-container">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fa-solid fa-users"></i> {{ __('site.supervisor.users.title') }}</h5>
                        <button class="btn btn-primary btn-sm" onclick="toggleUserForm()">
                            <i class="fa-solid fa-plus"></i> {{ __('site.supervisor.users.add_user') }}
                        </button>
                    </div>

                    <div class="card-body border-bottom d-none" id="userForm">
                        <h6 class="mb-4">{{ __('site.supervisor.users.create_new') }}</h6>
                        <form action="{{ route('supervisor.store') }}" method="POST" id="userCreateForm">
                            @method("post")
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('site.supervisor.users.form.first_name') }}</label>
                                        <input type="text" name="fName" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('site.supervisor.users.form.last_name') }}</label>
                                        <input type="text" name="lName" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('site.supervisor.users.form.email') }}</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('site.supervisor.users.form.mobileNumber') }}</label>
                                        <input type="number" name="mobileNumber" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('site.supervisor.users.form.user_type') }}</label>
                                        <select name="role" class="form-select custom-select" id="roleSelect" required>
                                            <option value="student">{{ __('site.login.student') }}</option>
                                            <option value="advisor">{{ __('site.login.advisor') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('site.supervisor.users.form.gender') }}</label>
                                        <select name="gender" class="form-control custom-select" required>
                                            <option value="" disabled selected>{{ __('site.supervisor.users.form.select_gender') }}
                                            </option>
                                            <option value="male">{{ __('site.supervisor.users.form.male') }}</option>
                                            <option value="female">{{ __('site.supervisor.users.form.female') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('site.supervisor.users.form.password') }}</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('site.supervisor.users.form.confirm_password') }}</label>
                                        <input type="password" name="password_confirmation" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('site.supervisor.users.form.status') }}</label>
                                        <select name="status" class="form-control custom-select" required>
                                            <option value="" disabled selected>{{ __('site.supervisor.users.form.select_status') }}
                                            </option>
                                            <option value="active">{{ __('site.supervisor.users.form.active') }}</option>
                                            <option value="inactive">{{ __('site.supervisor.users.form.inactive') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button type="button" class="btn btn-secondary" onclick="toggleUserForm()">{{
                                            __('site.supervisor.users.form.cancel') }}</button>
                                        <button type="submit" class="btn btn-primary">{{ __('site.supervisor.users.form.create')
                                            }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover user-table">
                                <thead>
                                    <tr>
                                        <th>{{ __('site.supervisor.users.table.name') }}</th>
                                        <th>{{ __('site.supervisor.users.table.email') }}</th>
                                        <th>{{ __('site.supervisor.users.table.mobileNumber') }}</th>
                                        <th>{{ __('site.supervisor.users.table.gender') }}</th>
                                        <th>{{ __('site.supervisor.users.table.role') }}</th>
                                        <th>{{ __('site.supervisor.users.table.status') }}</th>
                                        <th>{{ __('site.supervisor.users.table.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{$user->fName}} {{ $user->lName }}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->mobileNumber}}</td>
                                        <td>{{ucfirst($user->gender)}}</td>
                                        <td><span class="badge bg-primary">{{ucfirst($user->getRoleNames()->first())}}</span></td>
                                        <td><span class="badge bg-{{ $user->status == 'active'?'success':'danger'}}">{{ucfirst($user->status)}}</span></td>
                                        <td>
                                            <!-- Buttons Container -->
                                            <div class="d-flex gap-2 align-items-center">
                                                <!-- Added flex container -->
                                                <!-- Edit Button -->
                                                <button class="btn btn-sm btn-outline-primary" onclick="toggleEditForm()" data-toggle="modal" data-target="#editUserModal">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>

                                                <!-- Delete Form -->
                                                <form method="POST" action="{{ route('supervisor.delete', $user->id) }}">
                                                    @csrf
                                                    @method('POST')
                                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content shadow-lg rounded-lg">
            <!-- Modal Header -->
            <div class="modal-header" style="background-color: #ddad27;">
                <h5 class="modal-title font-weight-bold text-white" id="editUserModalLabel">
                    <i class="fas fa-user-edit"></i> Edit User
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body" style="background-color: #fff;">
                <form method="POST" action="{{ route('supervisor.edit', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- First Name -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label font-weight-bold" style="color: #2c3e50;">
                                    <i class="fas fa-user" style="color: #ddad27;"></i> {{ __('site.supervisor.users.form.first_name') }}
                                </label>
                                <input type="text" name="fName" class="form-control rounded" style="border-color: #ddad27;" placeholder="Enter first name">
                            </div>
                        </div>

                        <!-- Last Name -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label font-weight-bold" style="color: #2c3e50;">
                                    <i class="fas fa-user" style="color: #ddad27;"></i> {{ __('site.supervisor.users.form.last_name') }}
                                </label>
                                <input type="text" name="lName" class="form-control rounded" style="border-color: #ddad27;" placeholder="Enter last name">
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label font-weight-bold" style="color: #2c3e50;">
                                    <i class="fas fa-envelope" style="color: #ddad27;"></i> {{ __('site.supervisor.users.form.email') }}
                                </label>
                                <input type="email" name="email" class="form-control rounded" style="border-color: #ddad27;" placeholder="Enter email">
                            </div>
                        </div>

                        <!-- Status Dropdown -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label font-weight-bold" style="color: #2c3e50;">
                                    <i class="fas fa-toggle-on" style="color: #ddad27;"></i> {{ __('site.supervisor.users.form.status') }}
                                </label>
                                <select name="status" class="form-control custom-select rounded" style="border-color: #ddad27;">
                                    <option value="" disabled selected>
                                        {{ __('site.supervisor.users.form.select_status') }}
                                    </option>
                                    <option value="active">
                                        {{ __('site.supervisor.users.form.active') }}
                                    </option>
                                    <option value="inactive">
                                        {{ __('site.supervisor.users.form.inactive') }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn px-4 py-2 shadow-sm rounded" style="background-color: #ddad27; color: white;">
                            <i class="fas fa-save"></i> Save Changes
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
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>


<script>
    function toggleUserForm() {
        const form = document.getElementById('userForm');
        form.classList.toggle('d-none');
    }

    function toggleEditForm() {
        const form = document.getElementById('editForm');
        form.classList.toggle('d-none');
    }

    // Add event listener to change form action based on role selection
    document.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.getElementById('roleSelect');
        const userForm = document.getElementById('userCreateForm');
        
        if (roleSelect && userForm) {
            // Set initial form action based on default selected role
            updateFormAction(roleSelect.value);
            
            // Update form action when role selection changes
            roleSelect.addEventListener('change', function() {
                updateFormAction(this.value);
            });
        }
        
        function updateFormAction(role) {
            if (role === 'student') {
                userForm.action = "{{ route('student.store') }}";
            } else {
                userForm.action = "{{ route('supervisor.store') }}";
            }
        }
    });
</script>
@endsection
