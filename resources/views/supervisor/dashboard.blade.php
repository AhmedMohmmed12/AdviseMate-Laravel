<!-- resources/views/supervisor/dashboard.blade.php -->
@extends('layouts.supervisor')

@section('content')
<div class="dashboard-cards">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-users text-primary"></i> {{ __('site.supervisor.dashboard.total_users') }}</h5>
                    <p class="card-text display-4">{{DB::table("users")->count();}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-clock-rotate-left text-success"></i> {{ __('site.supervisor.dashboard.activities_today') }}</h5>
                    <p class="card-text display-4">{{ \Spatie\Activitylog\Models\Activity::whereDate('created_at', today())->count() }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-triangle-exclamation text-danger"></i> {{ __('site.supervisor.dashboard.issues') }}</h5>
                    <p class="card-text display-4">12</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection