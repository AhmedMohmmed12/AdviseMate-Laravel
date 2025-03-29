<!-- resources/views/supervisor/dashboard.blade.php -->
@extends('layouts.AdviseMateAdvisor')
@section('title','Dashboard')
@section('content')
<div class="container-fluid p-0">
    <div class="row no-gutters">
        <main class="col-12 col-md-9 col-lg-10 ml-auto px-3 py-4 content">
            <div class="mt-4 mb-4"></div>
            
            <div class="dashboard-stats">
                <div class="stat-card">
                    <h3><i class="fas fa-users"></i> {{ __('site.supervisor.dashboard.total_users') }}</h3>
                    <div class="stat-number">{{DB::table("users")->count();}}</div>
                </div>
                
                <div class="stat-card">
                    <h3><i class="fas fa-sync-alt"></i> {{ __('site.supervisor.dashboard.activities_today') }}</h3>
                    <div class="stat-number">{{ \Spatie\Activitylog\Models\Activity::whereDate('created_at', today())->count() }}</div>
                </div>
                
                <div class="stat-card">
                    <h3><i class="fas fa-exclamation-triangle text-danger"></i> {{ __('site.supervisor.dashboard.issues') }}</h3>
                    <div class="stat-number">12</div>
                </div>
            </div>
            
            <!-- Additional dashboard content can go here -->
            
        </main>
    </div>
</div>
@endsection