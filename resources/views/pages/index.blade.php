<x-base-layout>
    <!--begin::Card-->
    <div class="card">

        <!--begin::Card body-->
        <div class="card-body pt-6">


            <div class="row">
                @if(auth()->user()->user_type === 'Staff')
                <!--begin:Col-->
                <div class="col-lg-8 mb-3 mb-lg-0 py-3 px-3 py-lg-6 px-lg-6 offset-1 settings">
                    <!--begin:Row-->

                    @if(auth()->user()->hasRole('Students'))
                    <div class="row" id="students">
                        <!--begin:Col-->
                        <h3>Students</h3>
                        @if(auth()->user()->hasPermissionTo('access-student-bio'))
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/student_bio" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-user text-info fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Student Bio</span>
                                        <span class="fs-7 fw-semibold text-muted">Create, update student biographical information, upload student documents, create student applications</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        @endif

                        <!--end:Col-->
                        <!--begin:Col-->
                        @if(auth()->user()->hasPermissionTo('access-proof-of-registration'))
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/student_docs/proof_of_registration" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-address-card text-warning fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Proof of Registrations</span>
                                        <span class="fs-7 fw-semibold text-muted">View and print student proof of registrations</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        @endif
                        @if(auth()->user()->hasPermissionTo('access-academic-record'))
                        <!--end:Col-->
                        <!--begin:Col-->
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/student_docs/academic_record" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-clipboard text-success fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Academic Records</span>
                                        <span class="fs-7 fw-semibold text-muted">View and print student academic records</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Col-->
                        @endif

                    </div>
                    @endif
                    @if(auth()->user()->hasRole('Admissions'))
                    <div class="separator separator-dashed mx-5 my-5"></div>
                    <div class="row" id="admission">
                        <h3>Admission</h3>

                        <!--begin:Col-->
                        @if(auth()->user()->hasPermissionTo('access-applications'))
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/admission/applications" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-list-check text-info fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Process Applications</span>
                                        <span class="fs-7 fw-semibold text-muted">Process academic applications</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        @endif
                        <!--end:Col-->
                    </div>
                    @endif
                    <!--end:Row-->
                    @if(auth()->user()->hasRole('Registration'))
                    <div class="separator separator-dashed mx-5 my-5"></div>
                    <div class="row" id="registration">
                        <h3>Registration</h3>
                        <!--begin:Col-->
                        @if(auth()->user()->hasPermissionTo('access-qualification-registration'))
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/registration/qualification" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-chalkboard-user text-primary fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Qualification Registration</span>
                                        <span class="fs-7 fw-semibold text-muted">Enrol students into their respective qualifications</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        @endif
                        <!--end:Col-->

                        @if(auth()->user()->hasPermissionTo('access-module-registration'))
                        <!--begin:Col-->
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/registration/modules" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-list text-secondary fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Module Registration</span>
                                        <span class="fs-7 fw-semibold text-muted">Register student modules</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        @endif
                        <!--end:Col-->
                        @if(auth()->user()->hasPermissionTo('access-module-management'))
                        <!--begin:Col-->
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/registration/module-management" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-file-pen text-info fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Module Management </span>
                                        <span class="fs-7 fw-semibold text-muted">Module cancellations and exemptions</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        </div>
                        @endif
                        <!--end:Menu item-->
                        @if(auth()->user()->hasPermissionTo('access-qualification-management'))
                        <!--begin:Col-->
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/registration/qualification-management" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-pen-to-square text-success fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Qualification Management </span>
                                        <span class="fs-7 fw-semibold text-muted">Update student enrolment details, and cancel qualifications</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        </div>
                        @endif
                        <!--end:Menu item-->
                    </div>
                    @endif
                    @if(auth()->user()->hasRole('Assessments'))
                    <div class="separator separator-dashed mx-5 my-5"></div>
                    <div class="row" id="assessment">
                        <h3>Assessments</h3>
                        <!--begin:Col-->
                        @if(auth()->user()->hasPermissionTo('access-marks-suppression'))
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/assessments/suppressions" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-ban text-primary fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Marks Suppression</span>
                                        <span class="fs-7 fw-semibold text-muted">Suppress student marks on the portal</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        @endif
                        <!--end:Col-->

                        <!--begin:Col-->
                        @if(auth()->user()->hasPermissionTo('access-module-allocations'))
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/assessments/module_allocations" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-person-circle-check text-info fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Module Allocations</span>
                                        <span class="fs-7 fw-semibold text-muted">Allocate modules to teaching staff</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        @endif
                        <!--end:Col-->

                        <!--begin:Col-->
                        @if(auth()->user()->hasPermissionTo('my-modules'))
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/assessments/my_modules" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-list text-secondary fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">My Modules</span>
                                        <span class="fs-7 fw-semibold text-muted">Attendance registers, module class lists, and class notes</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        </div>
                        @endif
                        <!--end:Menu item-->

                        <!--begin:Col-->
                        @if(auth()->user()->hasPermissionTo('access-continuous-assessments'))
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/assessments/continuous_assessments" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-hashtag text-success fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Continuous Assessments (CAs)</span>
                                        <span class="fs-7 fw-semibold text-muted">Capture CA Marks</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        </div>
                        @endif
                        <!--end:Menu item-->

                        <!--begin:Col-->
                        @if(auth()->user()->hasPermissionTo('access-examinations'))
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/assessments/examinations" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-file-excel text-dark fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Examinations</span>
                                        <span class="fs-7 fw-semibold text-muted">Capture student exam paper marks</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        </div>
                        @endif
                        <!--end:Menu item-->

                        <!--begin:Col-->
                        @if(auth()->user()->hasPermissionTo('access-process-final-marks'))
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/assessments/final_marks" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-square-poll-vertical text-warning fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Process Final Marks</span>
                                        <span class="fs-7 fw-semibold text-muted">Process final marks for the captured CAs and Examinations</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        </div>
                        @endif
                        <!--end:Menu item-->

                        <!--begin:Col-->
                        @if(auth()->user()->hasPermissionTo('access-exam-registration'))
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/assessments/exam_registrations" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-user-check text-danger fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Exam Registration</span>
                                        <span class="fs-7 fw-semibold text-muted">Enrol students into other exam types</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        </div>
                        @endif
                        <!--end:Menu item-->

                    </div>
                    @endif
                    @if(auth()->user()->hasRole('Promotions'))
                    <div class="separator separator-dashed mx-5 my-5"></div>
                    <div class="row" id="promotions">
                        <h3>Promotion</h3>
                        <!--begin:Col-->
                        @if(auth()->user()->hasPermissionTo('access-promotions'))
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/promotion" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-arrow-up-right-dots text-success fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Promotions</span>
                                        <span class="fs-7 fw-semibold text-muted">Promote students to the following year</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        @endif
                        <!--end:Col-->

                    </div>
                    @endif
                    @if(auth()->user()->hasRole('Finance'))
                    <div class="separator separator-dashed mx-5 my-5"></div>
                    <div class="row" id="finance">
                        <h3>Finance</h3>
                        <!--begin:Col-->
                        @if(auth()->user()->hasPermissionTo('access-cashier-paypoints'))
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/finance/cashier-paypoints" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-building-columns text-secondary fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Cashier Paypoints</span>
                                        <span class="fs-7 fw-semibold text-muted">Link cashiers to different pay points</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        @endif
                        <!--end:Col-->

                        <!--begin:Col-->
                        @if(auth()->user()->hasPermissionTo('access-cashier'))
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/finance/cashier" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-hand-holding-dollar text-info fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Cashier</span>
                                        <span class="fs-7 fw-semibold text-muted">Capture student payments</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        @endif
                        <!--end:Col-->
                        <!--begin:Col-->
                        @if(auth()->user()->hasPermissionTo('access-payments'))
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/finance/student_charges" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-money-check-dollar text-primary fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Payments</span>
                                        <span class="fs-7 fw-semibold text-muted">List student payments, re-print receipts</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        </div>
                        @endif
                        <!--end:Menu item-->

                        <!--begin:Col-->
                        @if(auth()->user()->hasPermissionTo('access-student-statements'))
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/finance/student_statements" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-file-invoice-dollar text-success fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Student Statements </span>
                                        <span class="fs-7 fw-semibold text-muted">Generate student statements</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        </div>
                        @endif
                        <!--end:Menu item-->

                        <!--begin:Col-->
                        @if(auth()->user()->hasPermissionTo('access-debit-memos'))
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/finance/debit_memos" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-money-bill-transfer text-danger fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Debit Memos</span>
                                        <span class="fs-7 fw-semibold text-muted">Process debit orders</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        </div>
                        @endif
                        <!--end:Menu item-->

                        <!--begin:Col-->
                        @if(auth()->user()->hasPermissionTo('access-debit-memos'))
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/finance/credit_memos" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-money-bill-transfer text-warning fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Credit Memos</span>
                                        <span class="fs-7 fw-semibold text-muted">Process credit memos</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        </div>
                        @endif
                        <!--end:Menu item-->
                    </div>
                    @endif
                    @if(auth()->user()->hasRole('Access Control'))
                    <div class="separator separator-dashed mx-5 my-5"></div>
                    <div class="row" id="access-control">
                        <h3>Access Control</h3>
                        <!--begin:Col-->
                        @if(auth()->user()->hasPermissionTo('access-permissions'))
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/access-control/permissions" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-eye text-warning fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Permissions</span>
                                        <span class="fs-7 fw-semibold text-muted">Create user permissions</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        @endif
                        <!--end:Col-->

                        <!--begin:Col-->
                        @if(auth()->user()->hasPermissionTo('access-roles'))
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/access-control" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-fingerprint text-danger fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Roles</span>
                                        <span class="fs-7 fw-semibold text-muted">Create user roles</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        @endif
                        <!--end:Col-->
                        <!--begin:Col-->
                        @if(auth()->user()->hasPermissionTo('access-users'))
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/users" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-user-lock text-primary fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Users</span>
                                        <span class="fs-7 fw-semibold text-muted">Create users</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        </div>
                        @endif
                        <!--end:Menu item-->

                    </div>
                    @endif
                    @if(auth()->user()->hasRole('Student Portal'))
                    <div class="separator separator-dashed mx-5 my-5"></div>
                    <div class="row" id="finance">
                        <h3>Student Portal</h3>
                        <!--begin:Col-->
                        @if(auth()->user()->hasPermissionTo('access-notice-board'))
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/portal/notice-board" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-bullhorn text-danger fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Notice Board</span>
                                        <span class="fs-7 fw-semibold text-muted">Post items on student notice board</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        @endif
                        <!--end:Col-->

                        <!--begin:Col-->
                        @if(auth()->user()->hasPermissionTo('access-student-blocks'))
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/portal/student_block" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-user-slash text-warning fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Student Blocks</span>
                                        <span class="fs-7 fw-semibold text-muted">Block students from accessing the portal</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        @endif
                        <!--end:Col-->
                        <!--begin:Col-->
                        @if(auth()->user()->hasPermissionTo('access-block-exceptions'))
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/portal/student_block_exceptions" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-share-from-square text-info fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Block Exceptions</span>
                                        <span class="fs-7 fw-semibold text-muted">Exclude certain students from being blocked on the portal</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        </div>
                        @endif
                        <!--end:Menu item-->

                        <!--begin:Col-->
                        @if(auth()->user()->hasPermissionTo('access-student-devices'))
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/portal/student_devices" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-sim-card text-primary fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Student Devices</span>
                                        <span class="fs-7 fw-semibold text-muted">Capture student 3G information</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        </div>
                        @endif
                        <!--end:Menu item-->

                        <!--begin:Col-->
                        @if(auth()->user()->hasPermissionTo('access-student-printing-services'))
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/other_fees" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-print text-success fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Student Printing Services</span>
                                        <span class="fs-7 fw-semibold text-muted">Student Printing Services</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        </div>
                        @endif
                        <!--end:Menu item-->

                    </div>
                    @endif
                    @if(auth()->user()->hasRole('System'))
                    <div class="separator separator-dashed mx-5 my-5"></div>
                    <div class="row" id="control-panel">
                        <h3>Control Panel</h3>
                        <!--begin:Col-->
                        @if(auth()->user()->hasPermissionTo('access-settings'))
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/system/settings" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-cog text-warning fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Settings</span>
                                        <span class="fs-7 fw-semibold text-muted">Define system setups</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        @endif
                        <!--end:Col-->

                        <!--begin:Col-->
                        @if(auth()->user()->hasPermissionTo('access-audit-log'))
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/log/audit" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-clipboard-question text-primary fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Audit Log</span>
                                        <span class="fs-7 fw-semibold text-muted">See who has done what and when</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        @endif
                        <!--end:Col-->
                        <!--begin:Col-->
                        @if(auth()->user()->hasPermissionTo('access-system-log'))
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/fee_types" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-gears text-info fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">System Log</span>
                                        <span class="fs-7 fw-semibold text-muted">See system errors</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        </div>
                        @endif
                        <!--end:Menu item-->
                    </div>

                    @endif

                </div>
                <!--end:Col-->
                @elseif(auth()->user()->user_type === 'Student')
                <div class="col-lg-8 mb-3 mb-lg-0 py-3 px-3 py-lg-6 px-lg-6 offset-1 settings">
                    <div class="row" id="profile">
                        <!--begin:Col-->
                        <h3>Profile</h3>
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/student/update-biographical" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-user text-info fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Biographical Information</span>
                                        <span class="fs-7 fw-semibold text-muted">Update my biographical information and contact details</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>

                        <!--end:Col-->
                        <!--begin:Col-->
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/student/documents" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-file-pdf text-warning fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">My Documents</span>
                                        <span class="fs-7 fw-semibold text-muted">Upload my documents</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Col-->
                        <!--begin:Col-->
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/student/applications" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-file-pen text-success fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">My Applications</span>
                                        <span class="fs-7 fw-semibold text-muted">Submit academic Application</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Col-->
                    </div>

                    <div class="separator separator-dashed mx-5 my-5"></div>
                    <div class="row" id="academic">
                        <!--begin:Col-->
                        <h3>Academic</h3>
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/student/academic/proof_of_registration" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-file-signature text-danger fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Proof of Registrations</span>
                                        <span class="fs-7 fw-semibold text-muted">View and print proof of registrations</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>

                        <!--end:Col-->
                        <!--begin:Col-->
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/student/academic/my_modules" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-book text-warning fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">My Modules</span>
                                        <span class="fs-7 fw-semibold text-muted">Access and download module notes.</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Col-->
                        <!--begin:Col-->
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/student/academic/assessments" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-file-circle-check text-secondary fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">My Assessments</span>
                                        <span class="fs-7 fw-semibold text-muted">View assignment and test marks</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Col-->

                        <!--begin:Col-->
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/student/academic/assessments" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-file-excel text-success fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Examinations</span>
                                        <span class="fs-7 fw-semibold text-muted">View my exam marks</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Col-->

                        <!--begin:Col-->
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/student/academic/assessments" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-file-lines text-info fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Academic Record</span>
                                        <span class="fs-7 fw-semibold text-muted">View and print academic records</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Col-->

                        <!--begin:Col-->
                        <div class="col-lg-6 mb-3">
                            <!--begin:Menu item-->
                            <div class="menu-item p-0 m-0">
                                <!--begin:Menu link-->
                                <a href="/account/statement" class="menu-link">
                                    <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">
                                        <i class="fa-solid fa-file-invoice-dollar text-primary fs-2"></i>
                                    </span>
                                    <span class="d-flex flex-column">
                                        <span class="fs-6 fw-bold text-gray-800">Account Statement</span>
                                        <span class="fs-7 fw-semibold text-muted">View and print my statement</span>
                                    </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Col-->
                    </div>

                    @endif
                </div>
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->

</x-base-layout>