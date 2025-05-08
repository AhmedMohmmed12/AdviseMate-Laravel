@extends('layouts.AdviseMateAdvisor')
@section('title','Profile')
@section('content')
        <main class="col-12 col-md-9 col-lg-10 ml-auto px-3 py-4 content">
            <div class="mt-4 mb-4">
                <h2>{{ __('site.advisor.profile.personal_info') }}</h2>
            </div>
            <div class="row">
                <!-- Personal Information Section -->
                <div class="col-md-6">
                    <div class="profile-card">
                        <h3>{{ __('site.advisor.profile.personal_info') }}</h3>
                        <button id="editButton" type="button" class="btn btn-sm btn-secondary mb-3">{{ __('site.advisor.profile.edit') }}</button>
                        
                        <form id="profileForm" method="POST" action="{{ route('advisor.profile.edit', Auth::id()) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>{{ __('site.advisor.profile.fname') }}</label>
                                <input type="text" class="form-control" value="{{ Auth::user()->fName }}" name="fName" disabled>
                            </div>
                            
                            <div class="form-group">
                                <label>{{ __('site.advisor.profile.lname') }}</label>
                                <input type="text" class="form-control" value="{{ Auth::user()->lName }}" name="lName" disabled>
                            </div>

                            <div class="form-group">
                                <label>{{ __('site.advisor.profile.email') }}</label>
                                <input type="email" class="form-control" value="{{ Auth::user()->email }}" name="email" disabled>
                            </div>

                            <div class="form-group">
                                <label>{{ __('site.advisor.profile.mobile') }}</label>
                                <input type="tel" class="form-control" value="{{ Auth::user()->mobileNumber }}" name="mobileNumber" disabled>
                            </div>

                            <button id="cancelButton" type="button" class="btn btn-danger mb-3 d-none">{{ __('Cancel') }}</button>
                            <button type="submit" class="btn btn-primary btn-block" disabled id="saveButton">
                                {{ __('site.advisor.profile.update_profile') }}
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Change Password Section -->
                <div class="col-md-6">
                    <div class="profile-card">
                        <h3>{{ __('site.advisor.profile.change_password') }}</h3>
                        <form method="POST" action="{{ route('advisor.profile.password') }}">
                            @csrf

                            <div class="form-group">
                                <label>{{ __('site.advisor.profile.new_password') }}</label>
                                <input type="password" class="form-control" name="new_password" required>
                            </div>

                            <div class="form-group">
                                <label>{{ __('site.advisor.profile.confirm_password') }}</label>
                                <input type="password" class="form-control" name="new_password_confirmation" required>
                            </div>

                            <button type="submit" class="btn btn-warning btn-block">
                                {{ __('site.advisor.profile.change_password') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </main>

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

    // Display success message on page load if session has success message
    @if(session('success'))
        toastr.success('{{ session('success') }}');
    @endif

    // Display error messages if any
    @if(session('error'))
        toastr.error('{{ session('error') }}');
    @endif

    @if($errors->any())
        @foreach($errors->all() as $error)
            toastr.error('{{ $error }}');
        @endforeach
    @endif

    // Configure toastr options
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000"
    };
</script>
@endsection 