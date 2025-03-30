@extends('layouts.AdviseMateAdvisor')
@section('title','Ticket')
@section('content')


        <main class="col-12 col-md-9 col-lg-10 ml-auto px-3 py-4 content">
            <div class="mt-4 mb-4">
                <h2>{{trans('site.advisor.tickets.title')}}</h2>
            </div>
            
            <div class="ticket-filter">
                <div class="row">
                    <div class="col-md-3">
                        <select class="form-control">
                            <option>{{trans('site.advisor.tickets.filters.all')}}</option>
                            <option>{{trans('site.advisor.tickets.filters.open')}}</option>
                            <option>{{trans('site.advisor.tickets.filters.closed')}}</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="ticket-table">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>{{trans('site.advisor.tickets.table.student')}}</th>
                            <th>{{trans('site.advisor.tickets.table.issue')}}</th>
                            <th>{{trans('site.advisor.tickets.table.priority')}}</th>
                            <th>{{trans('site.advisor.tickets.table.actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Khalid</td>
                            <td>{{trans('site.advisor.dashboard.course_overload')}}</td>
                            <td><span class="priority-high">{{trans('site.advisor.tickets.priority.high')}}</span></td>
                            <td class="action-icons">
                                <a href="#" title="{{trans('site.advisor.tickets.filters.open')}}">
                                    <i class="fas fa-check-circle"></i>
                                </a>
                                <a href="#" title="{{trans('site.advisor.tickets.filters.closed')}}">
                                    <i class="fas fa-times-circle"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>



@endsection