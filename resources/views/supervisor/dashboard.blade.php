<!-- resources/views/supervisor/dashboard.blade.php -->
@extends('layouts.supervisor')

@section('content')
<div class="dashboard-cards">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-users text-primary"></i> Total Users</h5>
                    <p class="card-text display-4">1,234</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-clock-rotate-left text-success"></i> Activities Today</h5>
                    <p class="card-text display-4">89</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-triangle-exclamation text-danger"></i> Issues</h5>
                    <p class="card-text display-4">12</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection