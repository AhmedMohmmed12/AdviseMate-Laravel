<?php 

return [
    'home' => 'Welcome',
    'dashboard' => [
        'upcoming_appointments' => 'Upcoming Appointments',
        'advisor_meeting' => 'Advisor Meeting',
        'course_selection' => 'Course Selection',
        'recent_tickets' => 'Recent Tickets',
        'registration_issue' => 'Registration Issue',
        'course_deletion' => 'Course deletion',
        'quick_actions' => 'Quick Actions',
        'new_ticket' => 'New Ticket',
        'schedule_meeting' => 'Schedule Meeting',
        'academic_calendar' => 'Academic Calendar',
        'calendar_coming_soon' => 'Interactive Calendar (Coming Soon)',
    ],
    'status' => [
        'open' => 'Open',
        'closed' => 'Closed',
        'upcoming' => 'Upcoming',
        'completed' => 'Completed'
    ],
    'tickets' => [
        'title' => 'Tickets',
        'create_new' => 'Create New Ticket',
        'financial_aid' => 'Financial Aid Question'
    ],
    'appointments' => [
        'title' => 'Appointments',
        'schedule_new' => 'Schedule New Appointment',
        'advisor_meeting' => 'Advisor Meeting',
        'career_counseling' => 'Career Counseling',
        'financial_discussion' => 'Financial Aid Discussion'
    ],
    'sidebar' => [
        'logo' => 'AdvisorMate',
        'home' => 'Home',
        'tickets' => 'Tickets',
        'appointments' => 'Appointments',
        'profile' => 'Profile',
        'settings' => 'Settings'
    ],
    'login' => [
        'welcome' => 'Welcome',
        'to_your' => 'to your',
        'select_role' => 'Select your role',
        'student' => 'Student',
        'advisor' => 'Advisor',
        'email' => 'Email',
        'email_placeholder' => 'Enter your email',
        'password' => 'Password',
        'password_placeholder' => 'Enter your password',
        'login_button' => 'Login',
        'remember_me' => 'Remember Me'
    ],
    'advisor' => [
        'dashboard' => [
            'welcome' => 'Welcome Back, Advisor!',
            'stats' => [
                'total_students' => 'Total Students',
                'pending_tickets' => 'Pending Tickets',
                'upcoming_appointments' => 'Upcoming Appointments'
            ],
            'recent_tickets' => 'Recent Student Tickets',
            'graduation_audit' => 'Graduation Audit',
            'course_overload' => 'Course Overload',
            'urgent' => 'Urgent',
            'in_review' => 'In Review',
            'todays_appointments' => "Today's Appointments",
            'meeting_with' => 'Meeting with',
            'course_advising' => 'Course Advising',
            'quick_actions' => 'Quick Actions',
            'view_tickets' => 'View All Tickets',
            'view_appointments' => 'View All Appointments'
        ],
        'appointments' => [
            'title' => 'Manage Appointments',
            'new_hours' => 'New Office Hours',
            'calendar' => 'Appointment Calendar',
            'upcoming' => 'Upcoming',
            'approve' => 'Approve',
            'reschedule' => 'Reschedule',
            'course_selection' => 'Course Selection'
        ],
        'students' => [
            'title' => 'Manage Students',
            'search' => 'Search students...',
            'filters' => [
                'all_programs' => 'All Programs',
                'computer_science' => 'Computer Science',
                'business' => 'Business Administration',
                'engineering' => 'Engineering',
                'all_statuses' => 'All Statuses',
                'active' => 'Active',
                'probation' => 'Probation',
                'graduated' => 'Graduated'
            ],
            'table' => [
                'name' => 'Student Name',
                'id' => 'Student ID',
                'program' => 'Program',
                'status' => 'Status',
                'actions' => 'Actions'
            ],
            'view_profile' => 'View Profile',
            'send_message' => 'Send Message',
            'academic_info' => 'Academic Info'
        ],
        'tickets' => [
            'title' => 'Student Tickets',
            'filters' => [
                'all' => 'All',
                'open' => 'Open',
                'closed' => 'Closed'
            ],
            'table' => [
                'student' => 'Student',
                'issue' => 'Issue',
                'priority' => 'Priority',
                'actions' => 'Actions'
            ],
            'priority' => [
                'high' => 'High',
                'medium' => 'Medium',
                'low' => 'Low'
            ]
        ]
    ],
    'supervisor' => [
        'dashboard' => [
            'title' => 'Supervisor Dashboard',
            'total_users' => 'Total Users',
            'activities_today' => 'Activities Today',
            'issues' => 'Issues'
        ],
        'users' => [
            'title' => 'User Management',
            'manage_users' => 'Manage Users',
            'manage_permissions' => 'Manage Permissions',
            'add_user' => 'Add User',
            'create_new' => 'Create New User',
            'form' => [
                'first_name' => 'First Name',
                'last_name' => 'Last Name',
                'email' => 'Email',
                'user_type' => 'User Type',
                'gender' => 'Gender',
                'select_gender' => 'Select Gender',
                'male' => 'Male',
                'female' => 'Female',
                'password' => 'Password',
                'confirm_password' => 'Confirm Password',
                'cancel' => 'Cancel',
                'create' => 'Create User'
            ],
            'table' => [
                'name' => 'Name',
                'email' => 'Email',
                'gender' => 'Gender',
                'role' => 'Role',
                'status' => 'Status',
                'actions' => 'Actions'
            ]
        ],
        'activity_log' => [
            'title' => 'Activity Log',
            'time' => 'Time',
            'user' => 'User',
            'activity' => 'Activity',
            'details' => 'Details',
            'view_details' => 'View Details',
            'no_details' => 'No additional details',
            'system' => 'System'
        ]
    ]
];

?>