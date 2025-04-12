@extends('layouts.AdviseMateAdvisor')
@section('title','Dashboard')
@section('content')

            <main class="col-12 col-md-9 col-lg-10 ml-auto px-3 py-4 content">
                <div class="mt-4 mb-4">
                    <h2>{{trans('site.advisor.dashboard.welcome')}}</h2>
                </div>
                
                <!-- Stats Row -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <h3>{{trans('site.advisor.dashboard.stats.total_students')}}</h3>
                            <div class="number">{{ $totalStudents }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-ticket-alt"></i>
                            </div>
                            <h3>{{trans('site.advisor.dashboard.stats.pending_tickets')}}</h3>
                            <div class="number">12</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <h3>{{trans('site.advisor.dashboard.stats.upcoming_appointments')}}</h3>
                            <div class="number">5</div>
                        </div>
                    </div>
                </div>
                
                <!-- Activity Row -->
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="activity-card">
                            <h3><i class="fas fa-ticket-alt mr-2"></i>{{trans('site.advisor.dashboard.recent_tickets')}}</h3>
                            <div class="activity-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <strong>Faris: {{trans('site.advisor.dashboard.graduation_audit')}}</strong>
                                    </div>
                                    <span class="badge badge-urgent">{{trans('site.advisor.dashboard.urgent')}}</span>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <strong>Mohammed: {{trans('site.advisor.dashboard.course_overload')}}</strong>
                                    </div>
                                    <span class="badge badge-review">{{trans('site.advisor.dashboard.in_review')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="activity-card">
                            <h3><i class="fas fa-calendar-alt mr-2"></i>{{trans('site.advisor.dashboard.todays_appointments')}}</h3>
                            <div class="activity-item">
                                <div>
                                    <strong>{{trans('site.advisor.dashboard.meeting_with')}} Ahmed</strong>
                                    <div>2:00 PM - {{trans('site.advisor.dashboard.course_advising')}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="activity-card">
                            <h3><i class="fas fa-bolt mr-2"></i>{{trans('site.advisor.dashboard.quick_actions')}}</h3>
                            <div class="text-center mb-3">
                                <button class="btn btn-action btn-block">
                                    <i class="fas fa-ticket-alt mr-2"></i>{{trans('site.advisor.dashboard.view_tickets')}}
                                </button>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-action btn-block">
                                    <i class="fas fa-calendar-alt mr-2"></i>{{trans('site.advisor.dashboard.view_appointments')}}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
@endsection