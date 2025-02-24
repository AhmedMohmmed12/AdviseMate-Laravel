@extends('layouts.supervisor')

@section('content')
<div class="users-table">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fa-solid fa-users-gear"></i> Manage Users</h5>
            <button class="btn btn-primary btn-sm" onclick="toggleUserForm()">
                <i class="fa-solid fa-plus"></i> Add User
            </button>
        </div>
        
        
        <div class="card-body border-bottom d-none" id="userForm">
            <h6 class="mb-4">Create New User</h6>
            <form action="{{ route('store') }}" method="POST">
                @method("post")
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">First Name</label>
                            <input type="text" name="fName" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="lName" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">User Type</label>
                            <select name="role" class="form-select" required>
                                <option value="student">Student</option>
                                <option value="advisor">Advisor</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select" required>
                                <option value="" disabled selected>Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex gap-2 justify-content-end">
                            <button type="button" class="btn btn-secondary" onclick="toggleUserForm()">Cancel</button>
                            <button type="submit" class="btn btn-primary">Create User</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample Data -->


                        @foreach ($users as $user)
                        <tr>
                            <td> {{$user->fName}}    {{ $user->lName }}   </td>
                            <td>{{$user->email}}</td>
                            <td><span class="badge bg-primary">Advisor</span></td>
                            <td><span class="badge bg-success"></span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleUserForm() {
        const form = document.getElementById('userForm');
        form.classList.toggle('d-none');
    }
</script>
@endsection