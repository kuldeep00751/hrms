<?php
return array(
    '' => array(
        'title'       => 'Dashboard',
        'description' => '',
        'view'        => 'index',
        'layout'      => array(
            'page-title' => array(
                'description' => true,
                'breadcrumb'  => false,
            ),
        ),
        'assets'      => array(
            'custom' => array(
                'js' => array(),
            ),
        ),
    ),

    

    'settings' => array(
        'title'       => 'Settings',
        'description' => '',
        'layout'      => array(
            'page-title' => array(
                'description' => true,
                'breadcrumb'  => false,
            ),
        ),
        'assets'      => array(
            'custom' => array(
                'js' => array(),
            ),
        ),
    ),

    'login'           => array(
        'title'  => 'Login',
        'assets' => array(
            'custom' => array(
                'js' => array(
                    'js/custom/authentication/sign-in/general.js',
                ),
            ),
        ),
        'layout' => array(
            'main' => array(
                'type' => 'blank', // Set blank layout
                'body' => array(
                    'class' => theme()->isDarkMode() ? '' : 'bg-body',
                ),
            ),
        ),
    ),

    'register'        => array(
        'title'  => 'Register',
        'assets' => array(
            'custom' => array(
                'js' => array(
                    'js/custom/authentication/sign-up/general.js',
                ),
            ),
        ),
        'layout' => array(
            'main' => array(
                'type' => 'blank', // Set blank layout
                'body' => array(
                    'class' => theme()->isDarkMode() ? '' : 'bg-body',
                ),
            ),
        ),
    ),

    'forgot-password' => array(
        'title'  => 'Forgot Password',
        'assets' => array(
            'custom' => array(
                'js' => array(
                    'js/custom/authentication/password-reset/password-reset.js',
                ),
            ),
        ),
        'layout' => array(
            'main' => array(
                'type' => 'blank', // Set blank layout
                'body' => array(
                    'class' => theme()->isDarkMode() ? '' : 'bg-body',
                ),
            ),
        ),
    ),

    'system' => array(
        'settings'  => array(
            'title'  => 'Settings',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                    ),
                ),
            )
        ),
    ),

    'academic_intakes' => array(
        '*' => array(
            'title' => 'Academic Intakes',
        ),
    ),

    'exam_papers' => array(
        '*' => array(
            'title' => 'Module Exam Papers',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        'js/custom/admission/admission.js',
                    ),
                ),
            )
        ),
    ),

    'academic_years' => array(
        '*' => array(
            'title' => 'Academic Years',
        ),
    ),

    'academic_processes' => array(
        '*' => array(
            'title' => 'Academic Processes',
        ),
    ),

    'campuses' => array(
        '*' => array(
            'title' => 'Campuses',
        ),
    ),

    'gender' => array(
        '*' => array(
            'title' => 'Gender',
        ),
    ),

    'student_docs' => array(
        'proof_of_registration' => array(
            'title' => 'Proof of Registration',
        ),
        'academic_record' => array(
            'title' => 'Academic Record',
        ),
        'student_letters' => array(
            'title' => 'Student Letters',
        ),
    ),
    
    'next_of_kin_relationship' => array(
        '*' => array(
            'title' => 'Next of Kin relationships',
        ),
    ),

    'student_types' => array(
        '*' => array(
            'title' => 'Student Types',
        ),
    ),

    'titles' => array(
        '*' => array(
            'title' => 'Titles',
        ),
    ),


    'registration_statuses' => array(
        '*' => array(
            'title' => 'Registration Status',
        ),
    ),

    'subject_fees' => array(
        '*' => array(
            'title' => 'Subject Fees',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        'js/custom/admission/admission.js',
                    ),
                ),
            )
        ),
    ),

    'course_fees' => array(
        '*' => array(
            'title' => 'Course Fees',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        'js/custom/admission/admission.js',
                    ),
                ),
            )
        ),
    ),

    'exam_mark_criterias' => array(
        '*' => array(
            'title' => 'Exam Mark Grading Scale',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        'js/custom/admission/admission.js',
                    ),
                ),
            )
        ),
    ),

    'final_mark_criterias' => array(
        '*' => array(
            'title' => 'Final Mark Grading Scale',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        'js/custom/admission/admission.js',
                    ),
                ),
            )
        ),
    ),

    'other_fees' => array(
        '*' => array(
            'title' => 'Other Fees',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        'js/custom/admission/admission.js',
                    ),
                ),
            )
        ),
    ),

    'log' => array(
        'settings'  => array(
            'title'  => 'Settings',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                    ),
                ),
            ),
        ),
        'audit'  => array(
            'title'  => 'Audit Log',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                    ),
                ),
            ),
        ),
        'system' => array(
            'title'  => 'System Log',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                    ),
                ),
            ),
        ),
    ),

    'student' => array(
        'biographical' => array(
            'title'  => 'Student Biographical',
            'view'   => 'student/biographical/index',
            'assets' => array(
                'custom' => array(
                    'js' => array(
                        'js/custom/widgets.js',
                        'assets/plugins/custom/formrepeater/formrepeater.bundle.js'
                    ),
                ),
            ),
        ),
        'update-biographical' => array(
            'title'  => 'Update Student Biographical',
            'view'   => 'student/biographical/edit',
            'assets' => array(
                'custom' => array(
                    'js' => array(
                        'js/custom/account/settings/profile-details.js',
                        'js/custom/account/settings/formrepeater.js',
                        'js/custom/account/settings/stepper.js',
                        'js/custom/account/applications/applications.js',
                        'js/custom/account/settings/school-leaving.js',
                        'js/custom/account/settings/signin-methods.js',
                        'js/custom/modals/two-factor-authentication.js',
                    ),
                ),
            ),
        ),
        'applications' => array(
            'title'  => 'My Applications',
            'view'   => 'student/applications/index',
            'assets' => array(
                'custom' => array(
                    'js' => array(
                        'js/custom/account/settings/profile-details.js',
                        'js/custom/account/settings/formrepeater.js',
                        'js/custom/account/settings/school-leaving.js',
                        'js/custom/account/settings/signin-methods.js',
                        'js/custom/modals/two-factor-authentication.js',
                    ),
                ),
            ),
        ),

        'settings' => array(
            'title'  => 'Account Settings',
            'assets' => array(
                'custom' => array(
                    'js' => array(
                        'js/custom/account/settings/profile-details.js',
                        'js/custom/account/settings/formrepeater.js',
                        'js/custom/account/settings/school-leaving.js',
                        'js/custom/account/settings/signin-methods.js',
                        'js/custom/modals/two-factor-authentication.js',
                    ),
                ),
            ),
        ),
        'dashboard' => array(
            'title'  => 'Student Portal',
            'view'   => 'student/dashboard/index',
            'assets' => array(
                'custom' => array(
                    'js' => array(
                        'js/custom/account/settings/profile-details.js',
                        'js/custom/account/settings/formrepeater.js',
                        'js/custom/account/settings/school-leaving.js',
                        'js/custom/account/settings/signin-methods.js',
                        'js/custom/modals/two-factor-authentication.js',
                    ),
                ),
            ),
        ),
    ),

    'student_bio' => array(
        'title' => 'Student Bio',
        'assets' => array(
            'custom' => array(
                'css' => array(
                    'plugins/custom/datatables/datatables.bundle.css',
                ),
                'js'  => array(
                    'plugins/custom/datatables/datatables.bundle.js',
                    'js/custom/admission/admission.js',
                ),
            ),
        ),
        'create' => array(
            'title'  => 'Student Bio',
            'view'  => 'applications/user_info/account',
            'assets' => array(
                'custom' => array(
                    'js' => array(
                        'js/custom/account/settings/profile-details.js',
                        'js/custom/account/settings/formrepeater.js',
                        'js/custom/account/settings/stepper.js',
                        'js/custom/account/applications/applications.js',
                        'js/custom/account/settings/school-leaving.js',
                        'js/custom/account/settings/signin-methods.js',
                        'js/custom/modals/two-factor-authentication.js',
                    ),
                ),
            ),
        ),
        'create_user_info' => array(
            '*' => array(
                'title'  => 'Update Student Bio',
                'view'  => 'applications/user_info/create',
                'assets' => array(
                    'custom' => array(
                        'js' => array(
                            'js/custom/account/settings/profile-details.js',
                            'js/custom/account/settings/formrepeater.js',
                            'js/custom/account/settings/stepper.js',
                            'js/custom/account/applications/applications.js',
                            'js/custom/account/settings/school-leaving.js',
                            'js/custom/account/settings/signin-methods.js',
                            'js/custom/modals/two-factor-authentication.js',
                        ),
                    ),
                ),
            ),
        ),
        'applications' => array(
            '*' => array(
                'title'  => 'Student Applications',
                'view'  => 'applications/user_info/account',
                'assets' => array(
                    'custom' => array(
                        'js' => array(
                            'js/custom/account/settings/profile-details.js',
                            'js/custom/account/settings/formrepeater.js',
                            'js/custom/account/settings/stepper.js',
                            'js/custom/account/applications/applications.js',
                            'js/custom/account/settings/school-leaving.js',
                            'js/custom/account/settings/signin-methods.js',
                            'js/custom/modals/two-factor-authentication.js',
                        ),
                    ),
                ),
                'create' => array(
                    'title'  => 'Student Applications',
                    'view'  => 'applications/user_info/account',
                    'assets' => array(
                        'custom' => array(
                            'js' => array(
                                'js/custom/account/settings/profile-details.js',
                                'js/custom/account/settings/formrepeater.js',
                                'js/custom/account/settings/stepper.js',
                                'js/custom/account/applications/applications.js',
                                'js/custom/account/settings/school-leaving.js',
                                'js/custom/account/settings/signin-methods.js',
                                'js/custom/modals/two-factor-authentication.js',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),

    'employees' => array(
        'title' => 'Employee Bio',
        'assets' => array(
            'custom' => array(
                'css' => array(
                    'plugins/custom/datatables/datatables.bundle.css',
                ),
                'js'  => array(
                    'plugins/custom/datatables/datatables.bundle.js',
                    'js/custom/admission/admission.js',
                ),
            ),
        ),
        'create' => array(
            'title'  => 'Add New Employee',
            'view'  => 'hr/employees/create',
            'assets' => array(
                'custom' => array(
                    'js' => array(
                        'js/custom/account/settings/profile-details.js',
                        'js/custom/account/settings/formrepeater.js',
                        'js/custom/account/settings/stepper.js',
                        'js/custom/account/applications/applications.js',
                        'js/custom/account/settings/school-leaving.js',
                        'js/custom/account/settings/signin-methods.js',
                        'js/custom/modals/two-factor-authentication.js',
                    ),
                ),
            ),
        ),
        'update' => array(
            '*' => array(
                'title'  => 'Update Student Bio',
                'view'  => 'applications/user_info/create',
                'assets' => array(
                    'custom' => array(
                        'js' => array(
                            'js/custom/account/settings/profile-details.js',
                            'js/custom/account/settings/formrepeater.js',
                            'js/custom/account/settings/stepper.js',
                            'js/custom/account/applications/applications.js',
                            'js/custom/account/settings/school-leaving.js',
                            'js/custom/account/settings/signin-methods.js',
                            'js/custom/modals/two-factor-authentication.js',
                        ),
                    ),
                ),
            ),
        ),
       
    ),

    'admission' => array(
        'title'  => 'Admissions',
        'assets' => array(
            'custom' => array(
                'js' => array(
                    'js/custom/account/settings/profile-details.js',
                    'js/custom/account/settings/formrepeater.js',
                    'js/custom/account/settings/school-leaving.js',
                    'js/custom/account/applications/applications.js',
                    'js/custom/account/settings/signin-methods.js',
                    'js/custom/modals/two-factor-authentication.js',
                ),
            ),
        ),

        'applications'  => array(
            'title'  => 'Admission Applications',
            'view'   => 'admission/applications/index',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        'js/custom/admission/admission.js',
                    ),
                ),
            ),
        ),
    ),


    'registration' => array(
        'title'  => 'Registration',
        'qualification'  => array(
            'title'  => 'Registration Applications',
            'view'   => 'registration/qualification/index',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        'js/custom/admission/admission.js',
                        'js/custom/admission/module_registration.js',
                    ),
                ),
            ),
        ),

        'modules'  => array(
            'title'  => 'Module Registrations',
            'view'   => 'registration/modules/index',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        'js/custom/admission/admission.js',
                        'js/custom/admission/module_registration.js',
                    ),
                ),
            ),
        ),

        'module-management'  => array(
            'title'  => 'Module Management',
            'view'   => 'registration/modules/module-management',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        'js/custom/admission/admission.js',
                        'js/custom/admission/module_registration.js',
                    ),
                ),
            ),
            
            '*' => array(
                'add-module' => array(
                    'title'  => 'Add Module',
                    'view'   => 'registration/modules/add',
                    'assets' => array(
                        'custom' => array(
                            'js'  => array(
                                'js/custom/admission/module_registration.js',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),

    'communication' => array(
        'title'  => 'Communication',
        'pdf-template'  => array(
            'title'  => 'Document Templates',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        'js/custom/admission/admission.js',
                    ),
                ),
            ),
        ),

        'email-logs' => array(
            'title' => 'Email Logs',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        'js/custom/admission/admission.js',
                    ),
                ),
            ),
        ),

        'letter'  => array(
            'create' => array(
                'title'  => 'Student Letters',
                'assets' => array(
                    'custom' => array(
                        'css' => array(
                            'plugins/custom/datatables/datatables.bundle.css',
                        ),
                        'js'  => array(
                            'plugins/custom/datatables/datatables.bundle.js',
                            'plugins/custom/ckeditor/ckeditor-document.bundle.js',
                            'js/custom/ckeditor/ckeditor.js',
                        ),
                    ),
                ),
            ),
            '*' => array(
                'edit' => array(
                    'title'  => 'Student Letters',
                    'assets' => array(
                        'custom' => array(
                            'css' => array(
                                'plugins/custom/datatables/datatables.bundle.css',
                            ),
                            'js'  => array(
                                'plugins/custom/datatables/datatables.bundle.js',
                                'plugins/custom/ckeditor/ckeditor-document.bundle.js',
                                'js/custom/ckeditor/ckeditor.js',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),

    'student_device_inventory'  => array(
        'title'  => 'Student Device Inventory',
        'assets' => array(
            'custom' => array(
                'css' => array(
                    'plugins/custom/datatables/datatables.bundle.css',
                ),
                'js'  => array(
                    'plugins/custom/datatables/datatables.bundle.js',
                    'js/custom/admission/admission.js',
                ),
            ),
        ),
    ),

    'student_devices'  => array(
        'title'  => 'Student Devices',
        'assets' => array(
            'custom' => array(
                'css' => array(
                    'plugins/custom/datatables/datatables.bundle.css',
                ),
                'js'  => array(
                    'plugins/custom/datatables/datatables.bundle.js',
                    'js/custom/admission/admission.js',
                ),
            ),
        ),
        'create' => array(
            'title'  => 'Student Devices',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        'js/custom/student-devices/student-devices.js',
                    ),
                ),
            ),
        ),
    ),

    'timetable' => array(
        'lecture' => array(
            'title' => 'Lectures Timetable',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/fullcalendar/fullcalendar.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/fullcalendar/fullcalendar.bundle.js',
                        'js/custom/timetable/lecture.js',
                    ),
                ),
            )
        ),
        'exam' => array(
            'title' => 'Exam Timetable',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/fullcalendar/fullcalendar.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/fullcalendar/fullcalendar.bundle.js',
                        'js/custom/timetable/exam.js',
                    ),
                ),
            )
        ),
    ),

    'assessments' => array(
        'title'  => 'Assessments',
        'assets' => array(
            'custom' => array(
                'js' => array(
                    'js/custom/account/settings/profile-details.js',
                    'js/custom/account/settings/formrepeater.js',
                    'js/custom/account/settings/school-leaving.js',
                    'js/custom/account/applications/applications.js',
                    'js/custom/account/settings/signin-methods.js',
                    'js/custom/modals/two-factor-authentication.js',
                    'plugins/custom/datatables/datatables.bundle.js',
                ),
            ),
        ),

        'continuous_assessments'  => array(
            'title'  => 'Continuous Assessments',
            'view'   => 'assessments/continuous_assessments/index',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        'js/custom/registration/registration.js',
                    ),
                ),
            ),
        ),

        'examinations'  => array(
            'title'  => 'Examinations',
            'view'   => 'assessments/examinations/index',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        'js/custom/registration/registration.js',
                    ),
                ),
            ),
        ),

        'module_allocations'  => array(
            'title'  => 'Module Allocation',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        'js/custom/admission/admission.js',
                        
                    ),
                ),
            ),
        ),



        'final_marks'  => array(
            'title'  => 'Final Marks',
            'view'   => 'assessments/final_marks/index',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        'js/custom/registration/registration.js',
                    ),
                ),
            ),
        ),

        'exam_papers' => array(
            '*' => array(
                'title' => 'Module Exam Papers',
                'assets' => array(
                    'custom' => array(
                        'css' => array(
                            'plugins/custom/datatables/datatables.bundle.css',
                        ),
                        'js'  => array(
                            'plugins/custom/datatables/datatables.bundle.js',
                            'js/custom/admission/admission.js',
                        ),
                    ),
                )
            ),
        ),
    ),

    'users' => array(
        'title' => 'Users',
        'assets' => array(
            'custom' => array(
                'css' => array(
                    'plugins/custom/datatables/datatables.bundle.css',
                ),
                'js'  => array(
                    'plugins/custom/datatables/datatables.bundle.js',
                    'js/custom/admission/admission.js',
                ),
            ),
        ),
        '*' => array(
            'edit' => array(
                'title' => 'Edit User',
            ),
        ),
    ),

    'access-control'   => array(
        'permissions' => array(
            'title' => 'Permissions',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        'js/custom/admission/admission.js',
                    ),
                ),
            )
        ),
        'roles' => array(
            'title' => 'Roles',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        'js/custom/admission/admission.js',
                    ),
                ),
            )
        ),
    ),

    'portal'  => array(
        'notice-board' => array(
            'title' => 'Notice Board',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        'js/custom/admission/admission.js',
                    ),
                ),
            ),
            'create' => array(
                'title' => 'Notice Board',
                'assets' => array(
                    'custom' => array(
                        'css' => array(
                            'plugins/global/plugins.bundle.css',
                        ),
                        'js'  => array(
                            'plugins/global/plugins.bundle.js',
                            'plugins/custom/ckeditor/ckeditor-document.bundle.js',
                            'js/custom/ckeditor/ckeditor.js',
                        ),
                    ),
                ),
            ),
            '*' => array(
                'edit' => array(
                    'title' => 'Notice Board',
                    'assets' => array(
                        'custom' => array(
                            'css' => array(
                                'plugins/global/plugins.bundle.css',
                            ),
                            'js'  => array(
                                'plugins/global/plugins.bundle.js',
                                'plugins/custom/ckeditor/ckeditor-document.bundle.js',
                                'js/custom/ckeditor/ckeditor.js',
                            ),
                        ),
                    ),
                )
            )
        )
    ),

    'exam_admission_criteria'  => array(
        'title' => 'Exam Admission Criteria',
        'assets' => array(
            'custom' => array(
                'css' => array(
                    'plugins/custom/datatables/datatables.bundle.css',
                ),
                'js'  => array(
                    'plugins/custom/datatables/datatables.bundle.js',
                    'js/custom/admission/admission.js',
                ),
            ),
        ),
    ),


    'dashboard'  => array(
        'academic' => array(
            'title' => 'Dashboard',
            'assets' => array(
                'custom' => array(
                    'css' => array(
                        'plugins/custom/datatables/datatables.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/datatables/datatables.bundle.js',
                        'js/custom/admission/admission.js',
                    ),
                ),
            )
        )
    ),

    'start_menu'  => array(
        'title' => 'Start menu',
        'assets' => array(
            'custom' => array(
                'css' => array(
                    'plugins/custom/datatables/datatables.bundle.css',
                ),
                'js'  => array(
                    'plugins/custom/datatables/datatables.bundle.js',
                    'js/custom/admission/admission.js',
                ),
            ),
        )
    ),
    

    // Documentation pages
    'documentation' => array(
        '*' => array(
            'assets' => array(
                'vendors' => array(
                    'css' => array(
                        'plugins/custom/prismjs/prismjs.bundle.css',
                    ),
                    'js'  => array(
                        'plugins/custom/prismjs/prismjs.bundle.js',
                    ),
                ),
                'custom'  => array(
                    'js' => array(
                        'js/custom/documentation/documentation.js',
                    ),
                ),
            ),

            'layout' => array(
                'base'    => 'docs', // Set base layout: default|docs

                // Content
                'content' => array(
                    'width'  => 'fixed', // Set fixed|fluid to change width type
                    'layout' => 'documentation'  // Set content type
                ),
            ),
        ),

        'getting-started' => array(
            'overview' => array(
                'title'       => 'Overview',
                'description' => '',
                'view'        => 'documentation/getting-started/overview',
            ),

            'build' => array(
                'title'       => 'Gulp',
                'description' => '',
                'view'        => 'documentation/getting-started/build/build',
            ),

            'multi-demo' => array(
                'overview' => array(
                    'title'       => 'Overview',
                    'description' => '',
                    'view'        => 'documentation/getting-started/multi-demo/overview',
                ),
                'build'    => array(
                    'title'       => 'Multi-demo Build',
                    'description' => '',
                    'view'        => 'documentation/getting-started/multi-demo/build',
                ),
            ),

            'file-structure' => array(
                'title'       => 'File Structure',
                'description' => '',
                'view'        => 'documentation/getting-started/file-structure',
            ),

            'customization' => array(
                'sass'       => array(
                    'title'       => 'SASS',
                    'description' => '',
                    'view'        => 'documentation/getting-started/customization/sass',
                ),
                'javascript' => array(
                    'title'       => 'Javascript',
                    'description' => '',
                    'view'        => 'documentation/getting-started/customization/javascript',
                ),
            ),

            'dark-mode' => array(
                'title' => 'Dark Mode Version',
                'view'  => 'documentation/getting-started/dark-mode',
            ),

            'rtl' => array(
                'title' => 'RTL Version',
                'view'  => 'documentation/getting-started/rtl',
            ),

            'troubleshoot' => array(
                'title' => 'Troubleshoot',
                'view'  => 'documentation/getting-started/troubleshoot',
            ),

            'changelog' => array(
                'title'       => 'Changelog',
                'description' => 'version and update info',
                'view'        => 'documentation/getting-started/changelog/changelog',
            ),

            'updates' => array(
                'title'       => 'Updates',
                'description' => 'components preview and usage',
                'view'        => 'documentation/getting-started/updates',
            ),

            'references' => array(
                'title'       => 'References',
                'description' => '',
                'view'        => 'documentation/getting-started/references',
            ),
        ),

        'general' => array(
            'datatables'   => array(
                'overview' => array(
                    'title'       => 'Overview',
                    'description' => 'plugin overview',
                    'view'        => 'documentation/general/datatables/overview/overview',
                ),
            ),
            'remove-demos' => array(
                'title'       => 'Remove Demos',
                'description' => 'How to remove unused demos',
                'view'        => 'documentation/general/remove-demos/index',
            ),
        ),

        'configuration' => array(
            'general'     => array(
                'title'       => 'General Configuration',
                'description' => '',
                'view'        => 'documentation/configuration/general',
            ),
            'menu'        => array(
                'title'       => 'Menu Configuration',
                'description' => '',
                'view'        => 'documentation/configuration/menu',
            ),
            'page'        => array(
                'title'       => 'Page Configuration',
                'description' => '',
                'view'        => 'documentation/configuration/page',
            ),
            'npm-plugins' => array(
                'title'       => 'Add NPM Plugin',
                'description' => 'Add new NPM plugins and integrate within webpack mix',
                'view'        => 'documentation/configuration/npm-plugins',
            ),
        ),
    ),
);
