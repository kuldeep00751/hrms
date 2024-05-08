<x-base-layout>
    <h4 class="text-muted">
        Hi, {{ auth()->user()->first_name}} {{ auth()->user()->last_name}}
    </h4>
    @if(!$isProfileComplete)
    <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
        <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->

        <!--end::Svg Icon-->
        <div class="d-flex flex-column">
            <h4 class="mb-1 text-danger">Incomplete profile Information</h4>
            <p>

                <span>Your profile information is incomplete. Please complete your profile information before submitting any application.</span>
            </p>
            <p>
                Please make sure you have completed the following fields:
            </p>
            <ul>
                <li>Uploaded your passport photo</li>
                <li>Title</li>
                <li>Gender</li>
                <li>Date of Birthday</li>
                <li>Citizenship</li>
            </ul>
        </div>
    </div>
    @endif
    @if(!count(optional($studentInfo)->application))
    <div class="alert alert-primary d-flex align-items-center p-5 mb-10">
        <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
        <span class="svg-icon svg-icon-2hx svg-icon-primary me-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
                <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor"></path>
            </svg>
        </span>
        <!--end::Svg Icon-->
        <div class="d-flex flex-column">
            <h4 class="mb-1 text-primary">What would you like to study?</h4>
            <span>You do not have any application information. Please complete your application form under <strong>Profile -> My Applications -> New Application</strong></span>
        </div>
    </div>
    @endif
    <div class="card mb-5">
        <div class="card-header">
            <h6 class="fw-bolder m-0">PROFILE OVERVIEW</h6>
        </div>
        <div class="card-body pt-9 pb-0">
            <!--begin::Details-->
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                <!--begin: Pic-->
                <div class="me-7 mb-4">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        @if(auth()->user()->info->passport_photo)
                        <img src="{{ asset('storage/'.auth()->user()->info->passport_photo) }}" alt="image" />
                        <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border-white h-20px w-20px"></div>
                        @else
                        <img src="{{ asset('assets/media/avatars/blank.png') }}" alt="image" />
                        <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border-white h-20px w-20px"></div>
                        @endif
                    </div>
                </div>
                <!--end::Pic-->

                <!--begin::Info-->
                <div class="flex-grow-1">
                    <!--begin::Title-->
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <!--begin::User-->
                        <div class="d-flex flex-column">

                            <div class="row">
                                <div class="col-md-4 col-sm-12 b-r"> <strong>Full Name</strong>
                                    <br>
                                    <p class="text-muted">{{ optional($studentInfo->title)->title }} {{ optional($studentInfo)->first_names }} {{ optional($studentInfo)->surname }}</p>
                                </div>
                                <div class="col-md-4 col-sm-12 b-r"> <strong>Student Number</strong>
                                    <br>
                                    <p class="text-muted">{{ optional($studentInfo)->student_number }}</p>
                                </div>
                                <div class="col-md-4 col-sm-12 b-r"> <strong>Mobile Number</strong>
                                    <br>
                                    <p class="text-muted">{{ optional($studentInfo)->mobile_number }}</p>
                                </div>
                                <div class="col-md-4 col-sm-12 b-r"> <strong>Email Address</strong>
                                    <br>
                                    <p class="text-muted">{{ optional($studentInfo)->email_address }}</p>
                                </div>
                                <div class="col-md-4 col-sm-12"> <strong>Gender</strong>
                                    <br>
                                    <p class="text-muted">{{ optional($studentInfo->gender)->gender_type }}</p>
                                </div>
                                <div class="col-md-4 col-sm-12"> <strong>Birthdate</strong>
                                    <br>
                                    <p class="text-muted">{{ date('d M, Y',strtotime(optional($studentInfo)->date_of_birth)) }}</p>
                                </div>
                                <div class="col-md-4 col-sm-12"> <strong>ID Number</strong>
                                    <br>
                                    <p class="text-muted">{{ optional($studentInfo)->id_number }}</p>
                                </div>
                                <div class="col-md-4 col-sm-12"> <strong>Last School Attended</strong>
                                    <br>
                                    <p class="text-muted">{{ optional($studentInfo)->last_school_attended }}</p>
                                </div>
                                <div class="col-md-4 col-sm-12"> <strong>Citizenship</strong>
                                    <br>
                                    <p class="text-muted">{{ optional($studentInfo)->citizenship_status }}</p>
                                </div>
                            </div>
                        </div>
                        <!--end::User-->

                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9 bg-white">
                            <a href="{{ theme()->getPageUrl('student/profile') }}" class="btn btn-white btn-active-light-primary border me-2">{{ __('View Profile') }}</a>

                            <a href="{{ theme()->getPageUrl('student/update-biographical') }}" class="btn btn-active-light-primary border me-2" id="kt_account_profile_details_submit">
                                {{ __('Update Profile') }}
                            </a>

                            <a href="{{ theme()->getPageUrl('student/update-biographical') }}" class="btn btn-primary">
                                {{ __('Submit Application') }}
                            </a>
                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Info-->
            </div>
            <!--end::Details-->

            <!--begin::Navs-->
            <!-- <div class="d-flex overflow-auto h-55px">
            
        </div> -->
            <!--begin::Navs-->
        </div>
    </div>
    <div class="col-md-8 col-sm-12 mx-auto">
        @foreach($studentNoticeBoards as $studentNoticeBoard)
        <div class="card mb-5">
            <div class="card-body">
                <a href="{{ route('notice-boards.student-notice-board.show', $studentNoticeBoard->id) }}" class="text-dark fw-bolder text-hover-primary fs-6">
                    <div class="d-flex align-items-center">
                        <div class="d-flex justify-content-start flex-column">
                            {{ $studentNoticeBoard->title }} <small> <span class="{{ $studentNoticeBoard->getCategoryClassNames($studentNoticeBoard->category) }}">{{ $studentNoticeBoard->category }}</span></small>
                            <span class="text-muted fw-bold text-muted d-block fs-7 mb-3">
                                {{ $studentNoticeBoard->short_description }}
                            </span>
                            <i>Posted {{ \Carbon\Carbon::createFromTimeStamp(strtotime($studentNoticeBoard->created_at))->diffForHumans() }}</i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</x-base-layout>