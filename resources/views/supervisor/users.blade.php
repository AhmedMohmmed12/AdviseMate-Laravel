@extends('layouts.supervisor')

@section('content')
<div class="users-table">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fa-solid fa-users-gear"></i> {{ __('site.supervisor.users.title') }}</h5>
            <button class="btn btn-primary btn-sm" onclick="toggleUserForm()">
                <i class="fa-solid fa-plus"></i> {{ __('site.supervisor.users.add_user') }}
            </button>
        </div>

        <div class="card-body border-bottom d-none" id="userForm">
            <h6 class="mb-4">{{ __('site.supervisor.users.create_new') }}</h6>
            <form action="{{ route('supervisor.store') }}" method="POST">
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
                            <select name="role" class="form-select" required>
                                <option value="super_admin">{{ __('site.login.student') }}</option>
                                <option value="advisor">{{ __('site.login.advisor') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">{{ __('site.supervisor.users.form.gender') }}</label>
                            <select name="gender" class="form-select" required>
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
                            <select name="status" class="form-select" required>
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
                <table class="table table-hover">
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
                            <td><span class="badge bg-primary">Advisor</span></td>
                            <td><span class="badge bg-{{ $user->status == 'active'?'success':'danger'}}">{{ucfirst($user->status)}}</span></td>
                            <td>
                                <!-- Buttons Container -->
                                <div class="d-flex gap-2 align-items-center">
                                    <!-- Added flex container -->
                                    <!-- Edit Button -->
                                    <button class="btn btn-sm btn-outline-primary" onclick="toggleEditForm()">
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

                                <!-- Edit Form -->
                                <div class="card-body border-bottom d-none" id="editForm" >
                                    <form method="POST" action="{{ route('supervisor.edit', $user->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="col-md-6">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">{{
                                                            __('site.supervisor.users.form.first_name') }}</label>
                                                        <input type="text" name="fName" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">{{
                                                            __('site.supervisor.users.form.last_name') }}</label>
                                                        <input type="text" name="lName" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">{{
                                                            __('site.supervisor.users.form.email') }}</label>
                                                        <input type="email" name="email" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">{{ __('site.supervisor.users.form.status')
                                                        }}</label>
                                                    <select name="status" class="form-select" >
                                                        <option value="" disabled selected>{{
                                                            __('site.supervisor.users.form.select_status') }}</option>
                                                        <option value="active">{{
                                                            __('site.supervisor.users.form.active') }}</option>
                                                        <option value="inactive">{{
                                                            __('site.supervisor.users.form.inactive') }}</option>
                                                    </select>
                                                </div>
                                                <div class="d-flex gap-2 justify-content-end">
                                                    <button type="submit" class="btn btn-primary">Edit User</button>
                                                    <button type="button" class="btn btn-secondary" onclick="toggleEditForm()">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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

<script>
    function toggleUserForm() {
        const form = document.getElementById('userForm');
        form.classList.toggle('d-none');
    }

    function toggleEditForm() {
        const form = document.getElementById('editForm');
        form.classList.toggle('d-none');
    }

</script>
@endsection
