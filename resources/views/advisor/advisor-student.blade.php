@extends('layouts.HeadAdvisor')
@section('content')
    <x-advsidebar />
    <div class="main-content">
        <h1 class="header">{{trans('site.advisor.students.title')}}</h1>
        
        <div class="controls-section">
            <div class="search-bar">
                <input type="text" placeholder="{{trans('site.advisor.students.search')}}" class="search-input">
                <button class="search-button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            
            <div class="filters">
                <select class="filter-select">
                    <option>{{trans('site.advisor.students.filters.all_programs')}}</option>
                    <option>{{trans('site.advisor.students.filters.computer_science')}}</option>
                    <option>{{trans('site.advisor.students.filters.business')}}</option>
                    <option>{{trans('site.advisor.students.filters.engineering')}}</option>
                </select>
                <select class="filter-select">
                    <option>{{trans('site.advisor.students.filters.all_statuses')}}</option>
                    <option>{{trans('site.advisor.students.filters.active')}}</option>
                    <option>{{trans('site.advisor.students.filters.probation')}}</option>
                    <option>{{trans('site.advisor.students.filters.graduated')}}</option>
                </select>
            </div>
        </div>

        <div class="students-table">
            <div class="table-header">
                <div>{{trans('site.advisor.students.table.name')}}</div>
                <div>{{trans('site.advisor.students.table.id')}}</div>
                <div>{{trans('site.advisor.students.table.program')}}</div>
                <div>{{trans('site.advisor.students.table.status')}}</div>
                <div>{{trans('site.advisor.students.table.actions')}}</div>
            </div>
            
            <div class="table-row">
                <div class="student-info">
                    <div class="avatar">JD</div>
                    <div>
                        <strong>Abbas Mohammed</strong><br>
                        Abbas@gmail.com
                    </div>
                </div>
                <div>#STU-20235678</div>
                <div>{{trans('site.advisor.students.filters.computer_science')}}</div>
                <div><span class="status-indicator status-active">{{trans('site.advisor.students.filters.active')}}</span></div>
                <div class="actions">
                    <button class="icon-button" title="{{trans('site.advisor.students.view_profile')}}">
                        <i class="fas fa-user"></i>
                    </button>
                    <button class="icon-button" title="{{trans('site.advisor.students.send_message')}}">
                        <i class="fas fa-envelope"></i>
                    </button>
                    <button class="icon-button" title="{{trans('site.advisor.students.academic_info')}}">
                        <i class="fas fa-graduation-cap"></i>
                    </button>
                </div>
            </div>

            <div class="table-row">
                <div class="student-info">
                    <div class="avatar">AS</div>
                    <div>
                        <strong>Ahmed Mohammed</strong><br>
                        ahmed@gmail.com
                    </div>
                </div>
                <div>#STU-20231234</div>
                <div>{{trans('site.advisor.students.filters.business')}}</div>
                <div><span class="status-indicator status-probation">{{trans('site.advisor.students.filters.probation')}}</span></div>
                <div class="actions">
                    <button class="icon-button" title="{{trans('site.advisor.students.view_profile')}}">
                        <i class="fas fa-user"></i>
                    </button>
                    <button class="icon-button" title="{{trans('site.advisor.students.send_message')}}">
                        <i class="fas fa-envelope"></i>
                    </button>
                    <button class="icon-button" title="{{trans('site.advisor.students.academic_info')}}">
                        <i class="fas fa-graduation-cap"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection