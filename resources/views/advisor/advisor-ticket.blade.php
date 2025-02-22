@extends('layouts.HeadAdvisor')
@section('head')
    <x-advsidebar />
    <div class="main-content">
        <h1 class="header">{{trans('site.advisor.tickets.title')}}</h1>
        
        <div class="filters">
            <select id="status-filter">
                <option>{{trans('site.advisor.tickets.filters.all')}}</option>
                <option>{{trans('site.advisor.tickets.filters.open')}}</option>
                <option>{{trans('site.advisor.tickets.filters.closed')}}</option>
            </select>
        </div>

        <div class="tickets-table">
            <div class="ticket-header">
                <div>{{trans('site.advisor.tickets.table.student')}}</div>
                <div>{{trans('site.advisor.tickets.table.issue')}}</div>
                <div>{{trans('site.advisor.tickets.table.priority')}}</div>
                <div>{{trans('site.advisor.tickets.table.actions')}}</div>
            </div>
            <div class="ticket-item">
                <div>Khalid</div>
                <div>{{trans('site.advisor.dashboard.course_overload')}}</div>
                <div><span class="priority-high">{{trans('site.advisor.tickets.priority.high')}}</span></div>
                <div>
                    <button class="btn-respond" title="{{trans('site.advisor.tickets.filters.open')}}">
                        <i class="fas fa-close"></i>
                    </button>
                    <button class="btn-close" title="{{trans('site.advisor.tickets.filters.closed')}}">
                        <i class="fas fa-check"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection