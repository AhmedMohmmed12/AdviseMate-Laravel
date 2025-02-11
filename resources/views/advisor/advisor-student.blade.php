<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Students</title>
    <link rel="stylesheet" href="{{asset('/css/styles.css')}}">
</head>
<body>
{{-- resources/views/advisor-students.blade.php --}}
<x-advsidebar>

</x-advsidebar>
<div class="main-content">
    <h1 class="header">Manage Students</h1>
    
    {{-- Search and Filters --}}
    <div class="controls-section">
        <div class="search-bar">
            <input type="text" placeholder="Search students..." class="search-input">
            <button class="search-button">
                <i class="fas fa-search"></i>
            </button>
        </div>
        
        <div class="filters">
            <select class="filter-select">
                <option>All Programs</option>
                <option>Computer Science</option>
                <option>Business Administration</option>
                <option>Engineering</option>
            </select>
            <select class="filter-select">
                <option>All Statuses</option>
                <option>Active</option>
                <option>Probation</option>
                <option>Graduated</option>
            </select>
        </div>
    </div>

    {{-- Students Table --}}
    <div class="students-table">
        <div class="table-header">
            <div>Student Name</div>
            <div>Student ID</div>
            <div>Program</div>
            <div>Status</div>
            <div>Actions</div>
        </div>
        
        {{-- Sample Student Data --}}
        <div class="table-row">
            <div class="student-info">
                <div class="avatar">JD</div>
                <div>
                    <strong>John Doe</strong><br>
                    j.doe@university.edu
                </div>
            </div>
            <div>#STU-20235678</div>
            <div>Computer Science</div>
            <div><span class="status-indicator status-active">Active</span></div>
            <div class="actions">
                <button class="icon-button" title="View Profile">
                    <i class="fas fa-user"></i>
                </button>
                <button class="icon-button" title="Send Message">
                    <i class="fas fa-envelope"></i>
                </button>
                <button class="icon-button" title="Academic Info">
                    <i class="fas fa-graduation-cap"></i>
                </button>
            </div>
        </div>

        {{-- Add more rows as needed --}}
        <div class="table-row">
            <div class="student-info">
                <div class="avatar">AS</div>
                <div>
                    <strong>Alice Smith</strong><br>
                    a.smith@university.edu
                </div>
            </div>
            <div>#STU-20231234</div>
            <div>Business Administration</div>
            <div><span class="status-indicator status-probation">Probation</span></div>
            <div class="actions">
                <button class="icon-button" title="View Profile">
                    <i class="fas fa-user"></i>
                </button>
                <button class="icon-button" title="Send Message">
                    <i class="fas fa-envelope"></i>
                </button>
                <button class="icon-button" title="Academic Info">
                    <i class="fas fa-graduation-cap"></i>
                </button>
            </div>
        </div>
    </div>
</div>
</body>
</html>