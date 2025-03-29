@extends('layouts.AdviseMateAdvisor')
@section('title','Profile')
@section('content')
<div class="container-fluid p-0">
    <div class="row no-gutters">
        <main class="col-12 col-md-9 col-lg-10 ml-auto px-3 py-4 content">
            <div class="mt-4 mb-4">
                <h2>{{ __('site.supervisor.profile.personal_info') }}</h2>
            </div>
            <div class="row">
                <!-- Personal Information Section -->
                <div class="col-md-6">
                    <div class="profile-card">
                        <h3>{{ __('site.supervisor.profile.personal_info') }}</h3>
                        <button id="editButton" type="button" class="btn btn-sm btn-secondary mb-3">{{ __('Edit') }}</button>
                        
                        <form id="profileForm" method="POST" action="{{ route('supervisor.profile.edit', Auth::id()) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>{{ __('site.supervisor.profile.fname') }}</label>
                                <input type="text" class="form-control" value="{{ Auth::user()->fName }}" name="fName" disabled>
                            </div>
                            
                            <div class="form-group">
                                <label>{{ __('site.supervisor.profile.lname') }}</label>
                                <input type="text" class="form-control" value="{{ Auth::user()->lName }}" name="lName" disabled>
                            </div>

                            <div class="form-group">
                                <label>{{ __('site.supervisor.profile.email') }}</label>
                                <input type="email" class="form-control" value="{{ Auth::user()->email }}" name="email" disabled>
                            </div>

                            <div class="form-group">
                                <label>{{ __('site.supervisor.profile.mobile') }}</label>
                                <input type="tel" class="form-control" value="{{ Auth::user()->mobileNumber }}" name="mobileNumber" disabled>
                            </div>

                            <button id="cancelButton" type="button" class="btn btn-danger mb-3 d-none">{{ __('Cancel') }}</button>
                            <button type="submit" class="btn btn-primary btn-block" disabled id="saveButton">
                                {{ __('site.supervisor.profile.update_profile') }}
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Change Password Section -->
                <div class="col-md-6">
                    <div class="profile-card">
                        <h3>{{ __('site.supervisor.profile.change_password') }}</h3>
                        <form method="POST" action="{{ route('supervisor.profile.password') }}">
                            @csrf
                            <div class="form-group">
                                <label>{{ __('site.supervisor.profile.current_password') }}</label>
                                <input type="password" class="form-control" name="current_password" required>
                            </div>

                            <div class="form-group">
                                <label>{{ __('site.supervisor.profile.new_password') }}</label>
                                <input type="password" class="form-control" name="new_password" required>
                            </div>

                            <div class="form-group">
                                <label>{{ __('site.supervisor.profile.confirm_password') }}</label>
                                <input type="password" class="form-control" name="new_password_confirmation" required>
                            </div>

                            <button type="submit" class="btn btn-warning btn-block">
                                {{ __('site.supervisor.profile.change_password') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
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