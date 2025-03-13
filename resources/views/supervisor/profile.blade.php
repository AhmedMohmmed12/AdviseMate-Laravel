@extends('layouts.supervisor')

@section('content')
<div class="main-content">
    <h2>Profile</h2>
    <form id="userForm" action="" method="POST">
        @csrf
        <div class="form-group1">
            <label for="fName" class="form-label">First Name</label>
            <input type="text" id="fName" name="fName" class="form-control1" value="{{ old('fName', auth()->user()->fName) }}">
        </div>
        <div class="form-group1">
            <label for="lName" class="form-label">Last Name</label>
            <input type="text" id="lName" name="lName" class="form-control1" value="{{ old('lName', auth()->user()->lName) }}">
        </div>
        <div class="form-group1">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control1">
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection