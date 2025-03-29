<!-- resources/views/supervisor/activity-log.blade.php -->
@extends('layouts.AdviseMateAdvisor')
@section('title','ActivityLog')
@section('content')
<div class="container-fluid p-0">
    <div class="row no-gutters">
        <main class="col-12 col-md-9 col-lg-10 ml-auto px-3 py-4 content">
            <div class="mt-4 mb-4">
                <h2>{{ __('site.supervisor.activity_log.title') }}</h2>
            </div>
            
            <div class="activity-log-container">
                <div class="activity-log-header">
                    <i class="fas fa-list-ul"></i>
                    <h5>{{ __('site.supervisor.activity_log.title') }}</h5>
                </div>
                
                <div class="table-responsive">
                    <table class="table activity-log-table">
                        <thead>
                            <tr>
                                <th>{{ __('site.supervisor.activity_log.time') }}</th>
                                <th>{{ __('site.supervisor.activity_log.user') }}</th>
                                <th>{{ __('site.supervisor.activity_log.activity') }}</th>
                                <th>{{ __('site.supervisor.activity_log.details') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($activities as $activity)
                                <tr>
                                    <td>{{ $activity->created_at->diffForHumans() }}</td>
                                    <td>{{ $activity->causer ? $activity->causer->name : __('site.supervisor.activity_log.system') }}</td>
                                    <td>{{ $activity->description }}</td>
                                    <td>
                                        @if($activity->properties->count() > 0)
                                            <a href="#" class="view-details-btn" onclick="event.preventDefault(); this.nextElementSibling.classList.toggle('d-none');">
                                                <i class="fas fa-chevron-right"></i> {{ __('site.supervisor.activity_log.view_details') }}
                                            </a>
                                            <div class="d-none mt-2">
                                                <pre>{{ json_encode($activity->properties, JSON_PRETTY_PRINT) }}</pre>
                                            </div>
                                        @else
                                            {{ __('site.supervisor.activity_log.no_details') }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection