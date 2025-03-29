@extends('layouts.AdviseMate')
@section('title', 'Tickets')
@section('content')
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <main class="col-12 col-md-9 col-lg-10 ml-auto px-3 py-4">
                <div class="mt-4 mb-3">
                    <h2>{{trans('site.tickets.title')}}</h2>
                </div>
                <div class="card shadow-sm rounded">
                    <div class="card-body">
                        <button class="btn btn-primary mb-3">
                            <i class="fas fa-plus mr-2"></i> {{trans('site.tickets.create_new')}}
                        </button>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{trans('site.dashboard.registration_issue')}}
                                <span class="badge badge-open">{{trans('site.status.open')}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{trans('site.dashboard.course_deletion')}}
                                <span class="badge badge-closed">{{trans('site.status.closed')}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{trans('site.tickets.financial_aid')}}
                                <span class="badge badge-open">{{trans('site.status.open')}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection