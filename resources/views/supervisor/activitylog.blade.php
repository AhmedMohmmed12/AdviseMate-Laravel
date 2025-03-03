<!-- resources/views/supervisor/activity-log.blade.php -->
@extends('layouts.supervisor')

@section('content')
<div class="activity-log">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0"><i class="fa-solid fa-list-check"></i> {{ __('site.supervisor.activity_log.title') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
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
                                        <details>
                                            <summary>{{ __('site.supervisor.activity_log.view_details') }}</summary>
                                            <pre>{{ json_encode($activity->properties, JSON_PRETTY_PRINT) }}</pre>
                                        </details>
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
    </div>
</div>
@endsection