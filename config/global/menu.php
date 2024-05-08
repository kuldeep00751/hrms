<?php

return array(
    // Documentation menu
    'documentation' => array(
        // Getting Started
        array(
            'heading' => 'Getting Started',
        ),

        // Overview
        array(
            'title' => 'Overview',
            'path'  => 'http://educims.com/',
            // 'role' => ['admin'],
            // 'permission' => [],
        ),

        // Build
        array(
            'title' => 'Build',
            'path'  => 'documentation/getting-started/build',
        ),

        array(
            'title'      => 'Multi-demo',
            'attributes' => array("data-kt-menu-trigger" => "click"),
            'classes'    => array('item' => 'menu-accordion'),
            'sub'        => array(
                'class' => 'menu-sub-accordion',
                'items' => array(
                    array(
                        'title'  => 'Overview',
                        'path'   => 'documentation/getting-started/multi-demo/overview',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Build',
                        'path'   => 'documentation/getting-started/multi-demo/build',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),

        // File Structure
        array(
            'title' => 'File Structure',
            'path'  => 'documentation/getting-started/file-structure',
        ),

        // Customization
        array(
            'title'      => 'Customization',
            'attributes' => array("data-kt-menu-trigger" => "click"),
            'classes'    => array('item' => 'menu-accordion'),
            'sub'        => array(
                'class' => 'menu-sub-accordion',
                'items' => array(
                    array(
                        'title'  => 'SASS',
                        'path'   => 'documentation/getting-started/customization/sass',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Javascript',
                        'path'   => 'documentation/getting-started/customization/javascript',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),

        // Dark skin
        array(
            'title' => 'Dark Mode Version',
            'path'  => 'documentation/getting-started/dark-mode',
        ),

        // RTL
        array(
            'title' => 'RTL Version',
            'path'  => 'documentation/getting-started/rtl',
        ),

        // Troubleshoot
        array(
            'title' => 'Troubleshoot',
            'path'  => 'documentation/getting-started/troubleshoot',
        ),

        // Changelog
        array(
            'title'            => 'Changelog <span class="badge badge-changelog badge-light-danger bg-hover-danger text-hover-white fw-bold fs-9 px-2 ms-2">v'.theme()->getVersion().'</span>',
            'breadcrumb-title' => 'Changelog',
            'path'             => 'documentation/getting-started/changelog',
        ),

        // References
        array(
            'title' => 'References',
            'path'  => 'documentation/getting-started/references',
        ),


        // Separator
        array(
            'custom' => '<div class="h-30px"></div>',
        ),

        // Configuration
        array(
            'heading' => 'Configuration',
        ),

        // General
        array(
            'title' => 'General',
            'path'  => 'documentation/configuration/general',
        ),

        // Menu
        array(
            'title' => 'Menu',
            'path'  => 'documentation/configuration/menu',
        ),

        // Page
        array(
            'title' => 'Page',
            'path'  => 'documentation/configuration/page',
        ),

        // Page
        array(
            'title' => 'Add NPM Plugin',
            'path'  => 'documentation/configuration/npm-plugins',
        ),


        // Separator
        array(
            'custom' => '<div class="h-30px"></div>',
        ),

        // General
        array(
            'heading' => 'General',
        ),

        // DataTables
        array(
            'title'      => 'DataTables',
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array("data-kt-menu-trigger" => "click"),
            'sub'        => array(
                'class' => 'menu-sub-accordion',
                'items' => array(
                    array(
                        'title'  => 'Overview',
                        'path'   => 'documentation/general/datatables/overview',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),

        // Remove demos
        array(
            'title' => 'Remove Demos',
            'path'  => 'documentation/general/remove-demos',
        ),


        // Separator
        array(
            'custom' => '<div class="h-30px"></div>',
        ),

        // HTML Theme
        array(
            'heading' => 'HTML Theme',
        ),

        array(
            'title' => 'Components',
            'path'  => '//preview.keenthemes.com/metronic8/demo1/documentation/base/utilities.html',
        ),

        array(
            'title' => 'Documentation',
            'path'  => '//preview.keenthemes.com/metronic8/demo1/documentation/getting-started.html',
        ),
    ),

    // Main menu
    'main'          => array(
        //// Dashboard
        array(
            'title' => 'Dashboard',
            'user_type' => 'Staff',
            'path'  => '',
            'icon'  => theme()->getSvgIcon("demo1/media/icons/duotune/art/art002.svg", "svg-icon-2"),
        ),

        array(
            'title' => 'Dashboard',
            'user_type' => 'Student',
            'path'  => 'student/dashboard',
            'icon'  => theme()->getSvgIcon("demo1/media/icons/duotune/art/art002.svg", "svg-icon-2"),
        ),


        //// Modules
        array(
            'classes' => array('content' => 'pt-8 pb-2'),
            'content' => '<span class="menu-section text-muted text-uppercase fs-8 ls-1">Modules</span>',
        ),

        // Profile
        array(
            'title'      => 'Profile',
            'user_type' => 'Student',
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo1/media/icons/duotune/communication/com006.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-person fs-2"></i>',
            ),
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title'  => 'Biographical Information',
                        'path'   => 'student/biographical',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'My Documents',
                        'path'   => 'student/documents',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'My Applications',
                        'path'   => 'student/applications',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    
                ),
            ),
        ),
        //Academic 
        array(
            'title'      => 'Academic',
            'user_type' => 'Student',
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo1/media/icons/duotune/abstract/abs027.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-window fs-2"></i>',
            ),
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title'  => 'Proof Registration',
                        'path'   => 'student/academic/proof_of_registration',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'My Modules',
                        'path'   => 'student/academic/my_modules',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Assessments',
                        'path'   => 'student/academic/assessments',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Examination',
                        'path'   => 'student/academic/examination',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Academic Transcript',
                        'path'   => 'student/academic/transcript',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),

        //Student Account
        array(
            'title'      => 'Finance',
            'user_type' => 'Student',
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo1/media/icons/duotune/finance/fin010.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-window fs-2"></i>',
            ),
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title'  => 'Statement',
                        'path'   => 'account/statement',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),
        //Applications
        array(
            'title'      => 'Students',
            'user_type' => 'Staff',
            'role' => ['Students'],
            'permission' => ['access-student-bio', 'add-students', 'update-student-profiles', 'upload-student-documents', 'create-student-applications', 'access-proof-of-registration', 'access-academic-record'],
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo1/media/icons/duotune/communication/com014.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-window fs-2"></i>',
            ),
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title'  => 'Student Bio',
                        'path'   => 'student_bio',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'access-student-bio', 
                            'add-students', 
                            'update-student-profiles', 
                            'upload-student-documents', 
                            'create-student-applications'],
                    ),
                    array(
                        'title'  => 'Proof of Registration',
                        'path'   => 'student_docs/proof_of_registration',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => ['access-proof-of-registration'],
                    ),
                    array(
                        'title'  => 'Academic Record',
                        'path'   => 'student_docs/academic_record',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => ['access-academic-record'],
                    ),
                    array(
                        'title'  => 'Student Letters',
                        'path'   => 'student_docs/student_letters',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => ['access-student-letters'],
                    ),
                   
                ),
            ),
        ),
        // Admissions
        array(
            'title'      => 'Admission',
            'user_type' => 'Staff',
            'permission' => ['access-applications', 'show-application', 'process-application'],
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo1/media/icons/duotune/general/gen055.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-window fs-2"></i>',
            ),
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title'  => 'Process Applications',
                        'path'   => 'admission/applications',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => ['access-applications', 'show-application', 'process-application'],
                    ),
                ),
            ),
        ),

        // Registrations
        array(
            'title'      => 'Registration',
            'user_type' => 'Staff',
            'permission' => [
                'access-qualification-registration',
                'show-qualification-registrations',
                'register-student',

                'access-module-registration',
                'show-modules-modules',
                'register-student',

                'access-module-management',
                'access-module-actions',
                'exempt-modules',
                'cancel-modules',
                'remove-exemptions',
                'reverse-cancellations',

                'access-qualification-management',
                'access-qualification-actions',
                'cancel-qualifications',
                'reverse-qualification-cancellations'
            ],
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo1/media/icons/duotune/files/fil001.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-window fs-2"></i>',
            ),
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title'  => 'Qualification Registration',
                        'path'   => 'registration/qualification',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'access-qualification-registration',
                            'show-qualification-registrations',
                            'register-student'
                        ],
                    ),
                    array(
                        'title'  => 'Module Registration',
                        'path'   => 'registration/modules',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'access-module-registration',
                            'show-modules-modules',
                            'register-student',
                        ],
                    ),
                    array(
                        'title'  => 'Module Management',
                        'path'   => 'registration/module-management',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'access-module-management',
                            'access-module-actions',
                            'exempt-modules',
                            'cancel-modules',
                            'remove-exemptions',
                            'reverse-cancellations',
                        ],
                    ),
                    array(
                        'title'  => 'Qualification Management',
                        'path'   => 'registration/qualification-management',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'access-qualification-management',
                            'access-qualification-actions',
                            'cancel-qualifications',
                            'reverse-qualification-cancellations'
                        ],
                    ),
                ),
            ),
        ),

        //Assessments
        array(
            'title'      => 'Assessments',
            'user_type' => 'Staff',
            'permission' => [
                            'access-marks-suppression',
                            'suppress-marks',
                            'add-marks-suppression',

                            'access-module-allocations',
                            'allocate-modules',
                            'my-modules',
                            
                            'access-continuous-assessments',
                            
                            'access-examinations',
                            'access-process-final-marks',
                            'access-exam-registration',
                        ],
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo1/media/icons/duotune/text/txt010.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-window fs-2"></i>',
            ),
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title'  => 'Marks Suppression',
                        'path'   => 'assessments/suppressions',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'access-marks-suppression',
                            'suppress-marks',
                            'add-marks-suppression',
                        ],
                    ),
                    array(
                        'title'  => 'Module Allocations',
                        'path'   => 'assessments/module_allocations',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'access-module-allocations',
                            'allocate-modules',
                        ],
                    ),
                    array(
                        'title'  => 'My Modules',
                        'path'   => 'assessments/my_modules',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'my-modules',
                        ],
                    ),
                    array(
                        'title'  => 'Continuous Assessments',
                        'path'   => 'assessments/continuous_assessments',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'access-continuous-assessments',
                        ],
                    ),
                    array(
                        'title'  => 'Examinations',
                        'path'   => 'assessments/examinations',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'access-examinations',
                        ],
                    ),
                    array(
                        'title'  => 'Process Final Marks',
                        'path'   => 'assessments/final_marks',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'access-process-final-marks',
                        ],
                    ),
                    array(
                        'title'  => 'Exam Registration',
                        'path'   => 'assessments/exam_registration',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'access-exam-registration',
                        ],
                    ),
                ),
            ),
        ),

        // Promotions
        array(
            'title'      => 'Promotion',
            'user_type' => 'Staff',
            'role' => ['Promotions'],
            'permission' => [
                'access-promotions'
            ],
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo1/media/icons/duotune/arrows/arr003.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-window fs-2"></i>',
            ),
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title'  => 'Promotion',
                        'path'   => 'promotion',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'access-promotions'
                        ],
                    ),
                ),
            ),
        ),

        array(
            'title'      => 'Timetable',
            'user_type' => 'Staff',
            'role' => ['Timetable'],
            'permission' => [
                'access-class-timetable',
                'access-exam-timetable'
            ],
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo1/media/icons/duotune/general/gen066.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-window fs-2"></i>',
            ),
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title'  => 'Lectures Timetable',
                        'path'   => 'timetable/lecture',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'access-class-timetable'
                        ],
                    ),
                    array(
                        'title'  => 'Exam Timetable',
                        'path'   => 'timetable/exam',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'access-exam-timetable'
                        ],
                    ),
                ),
            ),
        ),

        //Cashier
        array(
            'title'      => 'Finance',
            'user_type' => 'Staff',
            'role' => ['Finance'],
            'permission' => [
                'access-cashier',
                'access-payments',
                'access-cashier-paypoints',
                'access-student-statements',
                'access-debit-memos',
                'access-credit-memos',
                'access-cashup-report',
            ],
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo1/media/icons/duotune/finance/fin010.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-window fs-2"></i>',
            ),
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title'  => 'Cashup Report',
                        'path'   => 'finance/cashup-report',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'access-cashup-report',
                        ],
                    ),
                    array(
                        'title'  => 'Cashier Paypoints',
                        'path'   => 'finance/cashier-paypoints',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'access-cashier-paypoints',
                        ],
                    ),
                    array(
                        'title'  => 'Cashier',
                        'path'   => 'finance/cashier',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'access-cashier',
                        ],
                    ),
                    array(
                        'title'  => 'Payments',
                        'path'   => 'finance/payments',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'access-payments',
                        ],
                    ),
                    array(
                        'title'  => 'Student Charges',
                        'path'   => 'finance/student_charges',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'access-student-charges'
                        ],
                    ),
                    array(
                        'title'  => 'Student Statement',
                        'path'   => 'finance/student_statements',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'access-student-statements',
                        ],
                    ),
                    array(
                        'title'  => 'Debit Memos',
                        'path'   => 'finance/debit_memos',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'access-debit-memos',
                        ],
                    ),
                    array(
                        'title'  => 'Credit Memos',
                        'path'   => 'finance/credit_memos',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'access-credit-memos',
                        ],
                    ),                
                ),
            ),
        ),

        // Access Control
        array(
            'title'      => 'Access Control',
            'user_type' => 'Staff',
            'role' => ['Access Control'],
            'permission' => [
                'access-permissions',
                'add-permissions',
                'edit-permissions',
                'show-permissions',

                'access-roles',
                'add-roles',
                'edit-roles',
                'show-roles',

                'access-users',
                'add-users',
                'edit-users',
                'show-users'
            ],
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo1/media/icons/duotune/arrows/arr076.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-window fs-2"></i>',
            ),
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title'  => 'Permissions',
                        'path'   => 'access-control/permissions',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Roles',
                        'path'   => 'access-control/roles',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Users',
                        'path'   => 'users',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                   
                ),
            ),
        ),

        // Promotions
        array(
            'title'      => 'Student Portal',
            'user_type' => 'Staff',
            'role' => ['Student Portal'],
            'permission' => [
                'access-notice-board',
                'add-notice-board-item',
                'edit-notice-board-item',

                'access-student-blocks',
                'add-student-block',
                'remove-student-block',
                'access-student-block-advanced-options',

                'access-block-exceptions',
                'add-block-exceptions',
                'edit-block-exceptions',
                'remove-block-exceptions',

                'access-student-devices',
                'add-student-devices',
                'edit-student-devices',
                'remove-student-devices',

                'access-student-printing-services',
                
            ],
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo1/media/icons/duotune/general/gen001.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-window fs-2"></i>',
            ),
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title'  => 'Notice Board',
                        'path'   => 'portal/notice-board',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Student Blocks',
                        'path'   => 'portal/student_block',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                   
                    array(
                        'title'  => 'Block Exceptions',
                        'path'   => 'portal/student_block_exceptions',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Student Devices',
                        'path'   => 'portal/student_devices',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Student Printing Service',
                        'path'   => 'portal/student_print_service',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),

        array(
            'title'      => 'Student Devices',
            'user_type' => 'Staff',
            'role' => ['Student Portal'],
            'permission' => [
                'access-student-devices',
                'add-student-devices',
                'edit-student-devices',
                'remove-student-devices',
            ],
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo1/media/icons/duotune/electronics/elc007.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-window fs-2"></i>',
            ),
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title'  => 'Inventory',
                        'path'   => 'student_device_inventory',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Device Allocation',
                        'path'   => 'student_devices',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),

        array(
            'title'      => 'Communication',
            'user_type' => 'Staff',
            'role' => ['Communication'],
            'permission' => [
                'access-pdf-template',
                'access-letters',

                'upload-template',
                'add-letter',
                'edit-letter',
                'delete-letter',
                'access-email-logs',
            ],
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo1/media/icons/duotune/communication/com002.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-window fs-2"></i>',
            ),
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title'  => 'Letters',
                        'path'   => 'communication/letters',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Email Log',
                        'path'   => 'communication/email-logs',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),
        array(
            'title'      => 'Human Resources',
            'user_type' => 'Staff',
            'role' => ['Human Resources'],
            'permission' => [
                'access-employees',
                'access-performance-management',
                'access-leave-applications',
                'access-employee-attendance-register',
                'access-payrol',

            ],
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo1/media/icons/duotune/communication/com014.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-window fs-2"></i>',
            ),
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title'      => 'Employee Bio',
                        'path'       => 'employees/',
                        'bullet'     => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'access-employees',
                        ],
                    ),
                    array(
                        'title'  => 'Leave Application',
                        'path'   => 'employees/leave-application',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'access-leave-applications',
                        ],
                    ),
                    array(
                        'title'  => 'Attendance Register',
                        'path'   => 'employees/attendance-register',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'access-employee-attendance-register',
                        ],
                    ),
                    array(
                        'title'  => 'Payroll',
                        'path'   => 'employees/payroll',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'access-payrol',
                        ],
                    ),
                    array(
                        'title'  => 'Performance Management',
                        'path'   => 'employees/performance-management',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'access-performance-management',
                        ],
                    ),
                ),
            ),
        ),

        array(
            'title'      => 'Reports',
            'user_type' => 'Staff',
            'role' => ['Reports'],
            'permission' => [
                'applications-report',
                'admissions-report',
                'registration-report',
                'module-allocations-report',
                'promotions-report',
                'payments-report',
                'debit-memos-report',
                'credit-memos-report',
                'access-control-report',
                'student-devices-report',
                'device-allocation-report',
                'employees-report',
                'employees-attendance-report',
                'payroll-report',
            ],
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo1/media/icons/duotune/graphs/gra010.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-window fs-2"></i>',
            ),
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title'  => 'Applications',
                        'path'   => 'reports/applications',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'applications-report',
                        ],
                    ),
                    array(
                        'title'  => 'Admissions Report',
                        'path'   => 'reports/admissions',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'admissions-report',
                        ],
                    ),
                    array(
                        'title'  => 'Registrations',
                        'path'   => 'reports/registrations',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'registration-report',
                        ],
                    ),
                    array(
                        'title'  => 'Module Allocations',
                        'path'   => 'reports/module-allocations',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'module-allocations-report',
                        ],
                    ),
                    array(
                        'title'  => 'Promotions',
                        'path'   => 'reports/promotions',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'promotions-report',
                        ],
                    ),

                    array(
                        'title'  => 'Payments',
                        'path'   => 'reports/payments',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'payments-report',
                        ],
                    ),
                    array(
                        'title'  => 'Debit Memos',
                        'path'   => 'reports/debit-memos',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'debit-memos-report',
                        ],
                    ),
                    array(
                        'title'  => 'Credit Memos',
                        'path'   => 'reports/credit-memos',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'credit-memos-report',
                        ],
                    ),
                    array(
                        'title'  => 'Access Control',
                        'path'   => 'reports/access-control',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'access-control-report',
                        ],
                    ),
                    array(
                        'title'  => 'Student Devices',
                        'path'   => 'reports/student-devices',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'student-devices-report',
                        ],
                    ),
                    array(
                        'title'  => 'Device Allocations',
                        'path'   => 'reports/device-allocations',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'device-allocation-report',
                        ],
                    ),
                    array(
                        'title'  => 'Employee Data',
                        'path'   => 'reports/employees',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'employees-report',
                        ],
                    ),
                    array(
                        'title'  => 'Employee Attendance',
                        'path'   => 'reports/employee-attendance',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'employees-attendance-report',
                        ],
                    ),
                    array(
                        'title'  => 'Payrol',
                        'path'   => 'reports/payrol',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'permission' => [
                            'payroll-report',
                        ],
                    ),
                ),
            ),
        ),

        // System
        array(
            'title'      => 'Control Panel',
            'user_type' => 'Staff',
            'role' => ['System'],
            'permission' => [
                'access-settings',
                'access-audit-log',
                'access-system-log'
            ],
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo1/media/icons/duotune/general/gen025.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-layers fs-3"></i>',
            ),
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title'      => 'Settings',
                        'path'       => 'system/settings',
                        'bullet'     => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Audit Log',
                        'path'   => 'log/audit',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'System Log',
                        'path'   => 'log/system',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),

        // Separator
        array(
            'content' => '<div class="separator mx-1 my-4"></div>',
        ),

    ),

    // Horizontal menu
    'horizontal'    => array(
        // Dashboard
        array(
            'title'   => 'Start Menu',
            'path'    => 'start_menu',
            'classes' => array('item' => 'me-lg-1'),
        ),
        array(
            'title'   => 'Dashboard',
            'path'    => '',
            'classes' => array('item' => 'me-lg-1'),
        ),
    ),
);
