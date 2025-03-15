@extends('layouts.supervisor')

@section('content')
<div class="profile-container">
    <div class="row g-4">
        <!-- Personal Information Section -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-4">{{ __('site.supervisor.profile.personal_info') }}</h4>

                    <button id="editButton" type="button" class="btn btn-secondary mb-3">{{ __('Edit') }}</button>
                    <form id="profileForm" method="POST" action="{{ route('supervisor.profile.edit', Auth::id()) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">{{ __('site.supervisor.profile.fname') }}</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->fName }}" name="fName" disabled>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">{{ __('site.supervisor.profile.lname') }}</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->lName }}" name="lName" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('site.supervisor.profile.email') }}</label>
                            <input type="email" class="form-control" value="{{ Auth::user()->email }}" name="email" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('site.supervisor.profile.mobile') }}</label>
                            <input type="tel" class="form-control" value="{{ Auth::user()->mobileNumber }}" name="mobileNumber" disabled>
                        </div>

                        <button id="cancelButton" type="button" class="btn btn-danger mb-3 d-none">{{ __('Cancel') }}</button>


                        <button type="submit" class="btn btn-primary w-100" disabled id="saveButton">
                            {{ __('site.supervisor.profile.update_profile') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Change Password Section -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-4">{{ __('site.supervisor.profile.change_password') }}</h4>
                    <form method="POST" action="{{ route('supervisor.profile.password') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">{{ __('site.supervisor.profile.current_password') }}</label>
                            <input type="password" class="form-control" name="current_password" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('site.supervisor.profile.new_password') }}</label>
                            <input type="password" class="form-control" name="new_password" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('site.supervisor.profile.confirm_password') }}</label>
                            <input type="password" class="form-control" name="new_password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-warning w-100">
                            {{ __('site.supervisor.profile.change_password') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('editButton').addEventListener('click', function () {
        let inputs = document.querySelectorAll('#profileForm input');
        let saveButton = document.getElementById('saveButton');
        let cancelButton = document.getElementById('cancelButton');

        // Enable inputs and buttons
        inputs.forEach(input => input.removeAttribute('disabled'));
        saveButton.removeAttribute('disabled');
        this.classList.add('d-none'); // Hide "Edit" button
        cancelButton.classList.remove('d-none'); // Show "Cancel" button
    });

    document.getElementById('cancelButton').addEventListener('click', function () {
        let inputs = document.querySelectorAll('#profileForm input');
        let saveButton = document.getElementById('saveButton');
        let editButton = document.getElementById('editButton');

        // Disable inputs and buttons
        inputs.forEach(input => input.setAttribute('disabled', 'true'));
        saveButton.setAttribute('disabled', 'true');
        this.classList.add('d-none'); // Hide "Cancel" button
        editButton.classList.remove('d-none'); // Show "Edit" button
    });
</script>

@endsection

<style>
.profile-container .card-title {
    border-bottom: 2px solid #eee;
    padding-bottom: 0.75rem;
    margin-bottom: 1.5rem;
}

.profile-container .form-label {
    font-weight: 500;
    color: #666;
}
</style>