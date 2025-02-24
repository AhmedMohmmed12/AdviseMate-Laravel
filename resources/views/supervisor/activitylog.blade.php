<!-- resources/views/supervisor/activity-log.blade.php -->
@extends('layouts.supervisor')

@section('content')
<div class="activity-log">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0"><i class="fa-solid fa-list-check"></i> Activity Log</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>User</th>
                            <th>Activity</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample Data -->
                        <tr>
                            <td>2 hours ago</td>
                            <td>Abbas</td>
                            <td>User Created</td>
                            <td>Created new user: ahmed@example.com</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection