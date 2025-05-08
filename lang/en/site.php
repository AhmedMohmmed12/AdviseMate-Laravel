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
        'logout' => 'Logout',
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
            'welcome' => 'Welcome Back',
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
            'view_appointments' => 'View All Appointments',
            'no_recent_tickets' => 'No recent tickets',
            'no_appointments_today' => 'No appointments today',
            'ticket' => 'Ticket',
            'pending' => 'Pending',
            'completed' => 'Completed',
            'rejected' => 'Rejected',
        ],
        'appointments' => [
            'title' => 'Manage Appointments',
            'new_hours' => 'New Office Hours',
            'calendar' => 'Appointment Calendar',
            'upcoming' => 'Upcoming',
            'approve' => 'Approve',
            'reject' => 'Reject',
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
                'inactive'=>'Inactive',
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
                'completed' => 'Completed',
                'pending' => 'Pending',
                'rejected' => 'Rejected',
            ],
            'table' => [
                'student' => 'Student',
                'issue' => 'Issue',
                'description' => 'Description',
                'status'=>'Status',
                'date' => 'Date',
                'priority' => 'Priority',
                'actions' => 'Actions'
            ],
            'priority' => [
                'high' => 'High',
                'medium' => 'Medium',
                'low' => 'Low'
            ]
        ],
        'profile' => [
            'personal_info' => 'Personal Information',
            'edit' => 'Edit',
            'fname' => 'First Name',
            'lname' => 'Last Name',
            'email' => 'Email',
            'mobile' => 'Mobile Number',
            'change_password' => 'Change Password',
            'new_password' => 'New Password',
            'confirm_password' => 'Confirm Password',
            'update_profile' => 'Update Profile',
            'updated_successfully' => 'Profile updated successfully',
            'password_updated' => 'Password updated successfully',
        ],
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
            'manage_advisor' => 'Manage Advisor',
            'add_user' => 'Add User',
            'create_new' => 'Create New User',
            'added_successfully' => 'User added successfully',
            'deleted_successfully' => 'User deleted successfully',
            'updated_successfully' => 'User updated successfully',
            'form' => [
                'first_name' => 'First Name',
                'last_name' => 'Last Name',
                'email' => 'Email',
                'mobileNumber' => 'Mobile Number',
                'user_type' => 'User Type',
                'gender' => 'Gender',
                'select_gender' => 'Select Gender',
                'male' => 'Male',
                'female' => 'Female',
                'status' => 'Status',
                'select_status' => 'Select Status',
                'active' => 'Active',
                'inactive' => 'Inactive',
                'password' => 'Password',
                'confirm_password' => 'Confirm Password',
                'cancel' => 'Cancel',
                'create' => 'Create User'
            ],
            'table' => [
                'name' => 'Name',
                'email' => 'Email',
                'program' =>'Program',
                'mobileNumber' => 'Mobile Number',
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
        ],
        'profile' => [
            'personal_info' => 'Personal Information',
            'fname' => 'First Name',
            'lname' => 'Last Name',
            'email' => 'Email',
            'mobile' => 'Mobile Number',
            'update_profile' => 'Update Profile',
            'change_password' => 'Change Password',
            'current_password' => 'Current Password',
            'new_password' => 'New Password',
            'confirm_password' => 'Confirm Password',
            'password_updated' => 'Password updated successfully',
            'current_password_incorrect' => 'Current password is incorrect'
            
        ],
        'login' => [
            'title' => 'Supervisor Login',
            'email' => 'Email',
            'password' => 'Password',
            'remember_me' => 'Remember Me',
            'submit' => 'Login',
            'failed' => 'Invalid email or password.'
        ],
        'permission' => [
            'title' => 'Manage Advisor-Student Assignments',
            'assign_student' => 'Assign Student to Advisor',
            'filter_options' => 'Filter Options',
            'advisor' => 'Advisor',
            'all_advisors' => 'All Advisors',
            'program' => 'Program',
            'all_programs' => 'All Programs',
            'status' => 'Status',
            'all_statuses' => 'All Statuses',
            'assigned' => 'Assigned',
            'unassigned' => 'Unassigned',
            'apply_filters' => 'Apply Filters',
            'clear_filters' => 'Clear Filters',
            'student_assignments' => 'Student Assignments',
            'student_id' => 'Student ID',
            'student_name' => 'Student Name',
            'current_advisor' => 'Current Advisor',
            'actions' => 'Actions',
            'unassign' => 'Unassign',
            'no_students' => 'No students found matching your criteria',
            'assign_modal' => [
                'title' => 'Assign Student to Advisor',
                'select_student' => 'Select Student',
                'select_advisor' => 'Select Advisor',
                'close' => 'Close',
                'assign' => 'Assign'
            ],
            'unassign_modal' => [
                'title' => 'Unassign Student',
                'confirm_message' => 'Are you sure you want to unassign this student from their current advisor?',
                'student' => 'Student',
                'current_advisor' => 'Current Advisor',
                'cancel' => 'Cancel',
                'unassign' => 'Unassign'
            ]
        ]
    ],
    'student' => [
        'profile' => [
            'personal_info' => 'Personal Information',
            'fname' => 'First Name',
            'lname' => 'Last Name',
            'email' => 'Email',
            'phone' => 'Phone Number',
            'change_password' => 'Change Password',
            'new_password' => 'New Password',
            'confirm_password' => 'Confirm Password',
            'update_profile' => 'Update Profile',
            'updated_successfully' => 'Profile updated successfully',
            'password_updated' => 'Password updated successfully',
            'edit' => 'Edit',
            'cancel' => 'Cancel'
        ],
    ]
];

?>