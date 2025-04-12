@extends('layouts.AdviseMate')
@section('title','Profile')
@section('content')
        <main class="col-12 col-md-9 col-lg-10 ml-auto px-3 py-4 content">
            <div class="mt-4 mb-4">
                <h2>{{ __('site.student.profile.personal_info') }}</h2>
            </div>
            <div class="row">
                <!-- Personal Information Section -->
                <div class="col-md-6">
                    <div class="profile-card">
                        <button id="editButton" type="button" class="btn btn-sm btn-secondary mb-3">{{ __('Edit') }}</button>
                        
                        <form id="profileForm" method="POST" action="{{ route('student.profile.edit', Auth::guard('student')->id()) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>{{ __('site.student.profile.fname') }}</label>
                                <input type="text" class="form-control" value="{{ Auth::guard('student')->user()->Fname }}" name="Fname" disabled>
                            </div>
                            
                            <div class="form-group">
                                <label>{{ __('site.student.profile.lname') }}</label>
                                <input type="text" class="form-control" value="{{ Auth::guard('student')->user()->LName }}" name="LName" disabled>
                            </div>

                            <div class="form-group">
                                <label>{{ __('site.student.profile.email') }}</label>
                                <input type="email" class="form-control" value="{{ Auth::guard('student')->user()->email }}" name="email" disabled>
                            </div>

                            <div class="form-group">
                                <label>{{ __('site.student.profile.phone') }}</label>
                                <input type="tel" class="form-control" value="{{ Auth::guard('student')->user()->phoneNumber }}" name="phoneNumber" disabled>
                            </div>

                            <button id="cancelButton" type="button" class="btn btn-danger mb-3 d-none">{{ __('Cancel') }}</button>
                            <button type="submit" class="btn btn-primary btn-block" disabled id="saveButton">
                                {{ __('site.student.profile.update_profile') }}
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Change Password Section -->
                <div class="col-md-6">
                    <div class="profile-card">
                        <h3>{{ __('site.student.profile.change_password') }}</h3>
                        <form method="POST" action="{{ route('student.profile.password') }}">
                            @csrf

                            <div class="form-group">
                                <label>{{ __('site.student.profile.new_password') }}</label>
                                <input type="password" class="form-control" name="new_password" required>
                            </div>

                            <div class="form-group">
                                <label>{{ __('site.student.profile.confirm_password') }}</label>
                                <input type="password" class="form-control" name="new_password_confirmation" required>
                            </div>

                            <button type="submit" class="btn btn-warning btn-block">
                                {{ __('site.student.profile.change_password') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </main>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const editButton = document.getElementById('editButton');
                const cancelButton = document.getElementById('cancelButton');
                const saveButton = document.getElementById('saveButton');
                const formInputs = document.querySelectorAll('#profileForm input[type="text"], #profileForm input[type="email"], #profileForm input[type="tel"]');

                editButton.addEventListener('click', function() {
                    formInputs.forEach(input => input.disabled = false);
                    editButton.classList.add('d-none');
                    cancelButton.classList.remove('d-none');
                    saveButton.disabled = false;
                });

                cancelButton.addEventListener('click', function() {
                    formInputs.forEach(input => {
                        input.disabled = true;
                        input.value = input.defaultValue;
                    });
                    editButton.classList.remove('d-none');
                    cancelButton.classList.add('d-none');
                    saveButton.disabled = true;
                });
            });
        </script>
@endsection 