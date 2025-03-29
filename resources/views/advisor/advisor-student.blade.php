@extends('layouts.AdviseMateAdvisor')
@section('title','Students')
@section('content')

    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <main class="col-12 col-md-9 col-lg-10 ml-auto px-3 py-4 content">
                <div class="mt-4 mb-4">
                    <h2>{{trans('site.advisor.students.title')}}</h2>
                </div>
                
                <div class="student-filter">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="{{trans('site.advisor.students.search')}}">
                                <div class="input-group-append">
                                    <button class="btn btn-warning" type="button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 ml-auto">
                            <select class="form-control">
                                <option>{{trans('site.advisor.students.filters.all_programs')}}</option>
                                <option>{{trans('site.advisor.students.filters.computer_science')}}</option>
                                <option>{{trans('site.advisor.students.filters.business')}}</option>
                                <option>{{trans('site.advisor.students.filters.engineering')}}</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control">
                                <option>{{trans('site.advisor.students.filters.all_statuses')}}</option>
                                <option>{{trans('site.advisor.students.filters.active')}}</option>
                                <option>{{trans('site.advisor.students.filters.probation')}}</option>
                                <option>{{trans('site.advisor.students.filters.graduated')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="student-table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{trans('site.advisor.students.table.name')}}</th>
                                <th>{{trans('site.advisor.students.table.id')}}</th>
                                <th>{{trans('site.advisor.students.table.program')}}</th>
                                <th>{{trans('site.advisor.students.table.status')}}</th>
                                <th>{{trans('site.advisor.students.table.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar">JD</div>
                                        <div>
                                            <div>Abbas Mohammed</div>
                                            <small class="text-muted">Abbas@gmail.com</small>
                                        </div>
                                    </div>
                                </td>
                                <td>#STU-20235678</td>
                                <td>{{trans('site.advisor.students.filters.computer_science')}}</td>
                                <td><span class="status-active">{{trans('site.advisor.students.filters.active')}}</span></td>
                                <td class="action-icons">
                                    <a href="#" title="{{trans('site.advisor.students.view_profile')}}"><i class="fas fa-user"></i></a>
                                    <a href="#" title="{{trans('site.advisor.students.send_message')}}"><i class="fas fa-envelope"></i></a>
                                    <a href="#" title="{{trans('site.advisor.students.academic_info')}}"><i class="fas fa-print"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar">AS</div>
                                        <div>
                                            <div>Ahmed Mohammed</div>
                                            <small class="text-muted">ahmed@gmail.com</small>
                                        </div>
                                    </div>
                                </td>
                                <td>#STU-20231234</td>
                                <td>{{trans('site.advisor.students.filters.business')}}</td>
                                <td><span class="status-probation">{{trans('site.advisor.students.filters.probation')}}</span></td>
                                <td class="action-icons">
                                    <a href="#" title="{{trans('site.advisor.students.view_profile')}}"><i class="fas fa-user"></i></a>
                                    <a href="#" title="{{trans('site.advisor.students.send_message')}}"><i class="fas fa-envelope"></i></a>
                                    <a href="#" title="{{trans('site.advisor.students.academic_info')}}"><i class="fas fa-print"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
@endsection