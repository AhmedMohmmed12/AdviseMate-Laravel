<main>
    
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{trans('site.advisor.students.title')}}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @if (app()->getLocale() == 'en')
    <link rel="stylesheet" href="{{asset('/css/styles.css')}}">
    @else
    <link rel="stylesheet" href="{{asset('/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style-ar.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    @endif

    @if (app()->getLocale() == 'ar')
    <style>
     /* advisor appointments */
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


  /* advisor dashboard */
        .stat-card i,
        .card-title i,
        .action-button i {
            transform: scaleX(-1);
            margin-left: 8px;
            margin-right: 0;
        }

 /* advisor student */

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


 /* advisor ticket */

 .btn-respond i,
        .btn-close i {
            transform: scaleX(-1);
            margin-left: 8px;
            margin-right: 0;
        }
        .ticket-header,
        .ticket-item {
            text-align: right;
        }
    </style>
    @endif
</head>
<body>
    @yield('content')  
</body>
</main>