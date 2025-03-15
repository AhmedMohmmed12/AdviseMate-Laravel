<?php 


return [
    'home' => 'مرحباً',
    'dashboard' => [
        'upcoming_appointments' => 'المواعيد القادمة',
        'advisor_meeting' => 'اجتماع المرشد',
        'course_selection' => 'اختيار المقرر',
        'recent_tickets' => 'التذاكر الحديثة',
        'registration_issue' => 'مشكلة في التسجيل',
        'course_deletion' => 'حذف المقرر',
        'quick_actions' => 'إجراءات سريعة',
        'new_ticket' => 'تذكرة جديدة',
        'schedule_meeting' => 'جدولة اجتماع',
        'academic_calendar' => 'التقويم الأكاديمي',
        'calendar_coming_soon' => 'التقويم التفاعلي (قريباً)',
    ],
    'status' => [
        'open' => 'مفتوح',
        'closed' => 'مغلق',
        'upcoming' => 'قادم',
        'completed' => 'مكتمل'
    ],
    'tickets' => [
        'title' => 'التذاكر',
        'create_new' => 'إنشاء تذكرة جديدة',
        'financial_aid' => 'سؤال عن المساعدة المالية'
    ],
    'appointments' => [
        'title' => 'المواعيد',
        'schedule_new' => 'جدولة موعد جديد',
        'advisor_meeting' => 'اجتماع المرشد',
        'career_counseling' => 'الإرشاد المهني',
        'financial_discussion' => 'مناقشة المساعدة المالية'
    ],
    'sidebar' => [
        'logo' => 'رفيق الإرشاد',
        'home' => 'الرئيسية',
        'tickets' => 'التذاكر',
        'appointments' => 'المواعيد',
        'profile' => 'الملف الشخصي',
        'logout' => 'تسجيل الخروج',
        'settings' => 'الإعدادات'
    ],
    'login' => [
        'welcome' => 'مرحباً',
        'to_your' => 'بك في',
        'select_role' => 'اختر حالتك الجامعية ',
        'student' => 'طالب',
        'advisor' => 'مرشد',
        'email' => 'البريد الإلكتروني',
        'email_placeholder' => 'أدخل بريدك الإلكتروني',
        'password' => 'كلمة المرور',
        'password_placeholder' => 'أدخل كلمة المرور',
        'login_button' => 'تسجيل الدخول',
        'remember_me' => 'تذكرني'
    ],
    'advisor' => [
        'dashboard' => [
            'welcome' => 'مرحباً بعودتك، أيها المرشد!',
            'stats' => [
                'total_students' => 'إجمالي الطلاب',
                'pending_tickets' => 'التذاكر المعلقة',
                'upcoming_appointments' => 'المواعيد القادمة'
            ],
            'recent_tickets' => 'تذاكر الطلاب الحديثة',
            'graduation_audit' => 'تدقيق التخرج',
            'course_overload' => 'زيادة المقررات',
            'urgent' => 'عاجل',
            'in_review' => 'قيد المراجعة',
            'todays_appointments' => 'مواعيد اليوم',
            'meeting_with' => 'اجتماع مع',
            'course_advising' => 'إرشاد المقررات',
            'quick_actions' => 'إجراءات سريعة',
            'view_tickets' => 'عرض جميع التذاكر',
            'view_appointments' => 'عرض جميع المواعيد'
        ],
        'appointments' => [
            'title' => 'إدارة المواعيد',
            'new_hours' => 'ساعات مكتبية جديدة',
            'calendar' => 'تقويم المواعيد',
            'upcoming' => 'القادمة',
            'approve' => 'موافقة',
            'reschedule' => 'إعادة جدولة',
            'course_selection' => 'اختيار المقررات'
        ],
        'students' => [
            'title' => 'إدارة الطلاب',
            'search' => 'البحث عن الطلاب...',
            'filters' => [
                'all_programs' => 'جميع البرامج',
                'computer_science' => 'علوم الحاسب',
                'business' => 'إدارة الأعمال',
                'engineering' => 'الهندسة',
                'all_statuses' => 'جميع الحالات',
                'active' => 'نشط',
                'probation' => 'تحت الإجراء',
                'graduated' => 'متخرج'
            ],
            'table' => [
                'name' => 'اسم الطالب',
                'id' => 'رقم الطالب',
                'program' => 'البرنامج',
                'status' => 'الحالة',
                'actions' => 'الإجراءات'
            ],
            'view_profile' => 'عرض الملف',
            'send_message' => 'إرسال رسالة',
            'academic_info' => 'المعلومات الأكاديمية'
        ],
        'tickets' => [
            'title' => 'تذاكر الطلاب',
            'filters' => [
                'all' => 'الكل',
                'open' => 'مفتوح',
                'closed' => 'مغلق'
            ],
            'table' => [
                'student' => 'الطالب',
                'issue' => 'المشكلة',
                'priority' => 'الأولوية',
                'actions' => 'الإجراءات'
            ],
            'priority' => [
                'high' => 'عالية',
                'medium' => 'متوسطة',
                'low' => 'منخفضة'
            ]
        ]
    ],
    'supervisor' => [
        'dashboard' => [
            'title' => 'لوحة تحكم المشرف',
            'total_users' => 'إجمالي المستخدمين',
            'activities_today' => 'نشاطات اليوم',
            'issues' => 'المشكلات'
        ],
        'users' => [
            'title' => 'إدارة المستخدمين',
            'manage_users' => 'إدارة المستخدمين',
            'manage_permissions' => 'إدارة الصلاحيات',
            'add_user' => 'إضافة مستخدم',
            'create_new' => 'إنشاء مستخدم جديد',
            'added_successfully' => 'تمت اضافة المستخدم بنجاح',
            'deleted_successfully' => 'تم حذف المستخدم بنجاح',
            'updated_successfully' => 'تم تحديث المستخدم بنجاح',
            'form' => [
                'first_name' => 'الاسم الأول',
                'last_name' => 'اسم العائلة',
                'email' => 'البريد الإلكتروني',
                'mobileNumber' => 'رقم الجوال',
                'user_type' => 'نوع المستخدم',
                'gender' => 'الجنس',
                'select_gender' => 'اختر الجنس',
                'male' => 'ذكر',
                'female' => 'أنثى',
                'status' => 'الحالة',
                'select_status' => 'اختر الحالة',
                'active' => 'نشط',
                'inactive' => 'غير نشط',
                'password' => 'كلمة المرور',
                'confirm_password' => 'تأكيد كلمة المرور',
                'cancel' => 'إلغاء',
                'create' => 'إنشاء مستخدم'
            ],
            'table' => [
                'name' => 'الاسم',
                'email' => 'البريد الإلكتروني',
                'mobileNumber' => 'رقم الجوال',
                'gender' => 'الجنس',
                'role' => 'الدور',
                'status' => 'الحالة',
                'actions' => 'الإجراءات'
            ]
        ],
        'activity_log' => [
            'title' => 'سجل النشاطات',
            'time' => 'الوقت',
            'user' => 'المستخدم',
            'activity' => 'النشاط',
            'details' => 'التفاصيل',
            'view_details' => 'عرض التفاصيل',
            'no_details' => 'لا توجد تفاصيل إضافية',
            'system' => 'النظام'
        ],
        'profile' => [
            'personal_info' => 'المعلومات الشخصية',
            'fname' => 'الاسم الأول',
            'lname' => 'اسم العائلة',
            'email' => 'البريد الإلكتروني',
            'mobile' => 'رقم الجوال',
            'update_profile' => 'تحديث البيانات',
            'change_password' => 'تغيير كلمة المرور',
            'current_password' => 'كلمة المرور الحالية',
            'new_password' => 'كلمة المرور الجديدة',
            'confirm_password' => 'تأكيد كلمة المرور',
            'password_updated' => 'تم تحديث كلمة المرور بنجاح',
            'current_password_incorrect' => 'كلمة المرور الحالية غير صحيحة',
        ],
        'login' => [
            'title' => 'تسجيل دخول المشرف',
            'email' => 'البريد الإلكتروني',
            'password' => 'كلمة المرور',
            'remember_me' => 'تذكرني',
            'submit' => 'تسجيل الدخول',
            'failed' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة'
        ]
    ]
];


?>