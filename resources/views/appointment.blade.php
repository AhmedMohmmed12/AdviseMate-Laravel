@extends('layouts.AdviseMate')
@section('title', trans('site.appointments.title'))
@section('content')
    <div class="container">
        <!-- Main Content -->
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <main class="col-12 col-md-9 col-lg-10 ml-auto px-3 py-4">
                    <div class="mt-4 mb-3">
                        <h2>{{ trans('site.appointments.title') }}</h2>
                    </div>
                    <div class="card shadow-sm rounded">
                        <div class="card-body">
                            <button class="btn btn-primary mb-3">
                                <i class="fas fa-calendar-plus mr-2"></i> {{ trans('site.appointments.schedule_new') }}
                            </button>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ trans('site.appointments.advisor_meeting') }}
                                    <span class="badge badge-upcoming">{{ trans('site.status.upcoming') }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ trans('site.appointments.career_counseling') }}
                                    <span class="badge badge-completed">{{ trans('site.status.completed') }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ trans('site.appointments.financial_discussion') }}
                                    <span class="badge badge-upcoming">{{ trans('site.status.upcoming') }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
@endsection