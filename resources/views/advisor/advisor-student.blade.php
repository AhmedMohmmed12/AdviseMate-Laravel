<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{trans('site.advisor.students.title')}}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @if (app()->getLocale() == 'en')
    <link rel="stylesheet" href="{{asset('/css/styles.css')}}">
    @else
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style-ar.css')}}">
    @endif

    @if (app()->getLocale() == 'ar')
    <style>
        .search-button i,
        .icon-button i {
            transform: scaleX(-1);
            margin-left: 8px;
            margin-right: 0;
        }
        .table-header,
        .table-row,
        .student-info {
            text-align: right;
        }
        .search-input {
            text-align: right;
        }
    </style>
    @endif
</head>
<body>
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