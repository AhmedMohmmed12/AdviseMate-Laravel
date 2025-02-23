@extends('layouts.HeadStudent')
@section('name')
    <div class="container">
        <!-- Sidebar -->
        <x-sidebar>
            
        </x-sidebar>

        <!-- Main Content -->
        <div class="main-content">
            <h1 class="header">{{trans('site.tickets.title')}}</h1>
            
            <div class="tickets-section">
                <div class="new-ticket">
                    <button class="action-button">
                        <i class="fas fa-plus"></i> {{trans('site.tickets.create_new')}}
                    </button>
                </div>
                <ul class="ticket-list">
                    <li class="ticket-item">
                        <div class="ticket-title">
                            {{trans('site.dashboard.registration_issue')}}
                        </div>
                        <div class="ticket-meta">
                            <span class="status-indicator status-open">{{trans('site.status.open')}}</span>
                        </div>
                    </li>
                    <li class="ticket-item">
                        <div class="ticket-title">
                            {{trans('site.dashboard.course_deletion')}}
                        </div>
                        <div class="ticket-meta">
                            <span class="status-indicator status-closed">{{trans('site.status.closed')}}</span>
                        </div>
                    </li>
                    <li class="ticket-item">
                        <div class="ticket-title">
                            {{trans('site.tickets.financial_aid')}}
                        </div>
                        <div class="ticket-meta">
                            <span class="status-indicator status-open">{{trans('site.status.open')}}</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection