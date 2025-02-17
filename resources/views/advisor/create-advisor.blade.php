@extends('dashboard')
@push('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

@endpush
@section('content')


<form action="{{ route('advisor.store') }}" method="POST">
    @method("post")
    @csrf
    <label>First Name</label>
    <input type="text" name="fName" class="form-control" >
    <label>Last Name</label>
    <input type="text" name="lName" class="form-control" >
    <label>First Name</label>
    <input type="text" name="email" class="form-control" >
    <label>Password</label>
    <input type="password" name="password" class="form-control" >
    <label>Password Confirmation</label>
    <input type="password" name="password_confirmation" class="form-control" >
    <input type="submit" >
</form>



@endsection