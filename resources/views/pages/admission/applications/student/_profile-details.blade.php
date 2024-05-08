<div class="d-flex flex-wrap flex-sm-nowrap mb-3">
    <div class="me-7 mb-4">
        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
            @if($application->userInfo->passport_photo)
            <img src="{{ asset('storage/'.$application->userInfo->passport_photo) }}" alt="image" />
            @else
            <img src="{{ asset('assets/media/avatars/blank.png') }}" alt="image" />
            @endif
        </div>
    </div>
    <div class="flex-grow-1">
        <!--begin::Title-->
        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
            <!--begin::User-->
            <div class="d-flex flex-column">

                <div class="row">
                    <div class="col-md-4 col-sm-12 b-r "> <strong>Full Name</strong>
                        <br>
                        <p class="text-muted">{{ $application->userInfo->title->title }} {{ $application->userInfo->first_names }} {{ $application->userInfo->surname }}</p>
                    </div>
                    <div class="col-md-4 col-sm-12 b-r"> <strong>Student Number</strong>
                        <br>
                        <p class="text-muted">{{ optional($application->userInfo)->student_number }}</p>
                    </div>
                    <div class="col-md-4 col-sm-12 b-r"> <strong>Mobile Number</strong>
                        <br>
                        <p class="text-muted">{{ optional($application->userInfo)->mobile_number }}</p>
                    </div>
                    <div class="col-md-4 col-sm-12 b-r"> <strong>Email Address</strong>
                        <br>
                        <p class="text-muted">{{ $application->userInfo->email_address }}</p>
                    </div>
                    <div class="col-md-4 col-sm-12"> <strong>Gender</strong>
                        <br>
                        <p class="text-muted"> {{ $application->userInfo->gender->gender_type }}</p>
                    </div>
                    <div class="col-md-4 col-sm-12"> <strong>Birthdate</strong>
                        <br>
                        <p class="text-muted">{{ date('d M, Y',strtotime(optional($application->userInfo)->date_of_birth)) }}</p>
                    </div>
                    <div class="col-md-4 col-sm-12"> <strong>ID Number</strong>
                        <br>
                        <p class="text-muted">{{ $application->userInfo->id_number }}</p>
                    </div>
                    <div class="col-md-4 col-sm-12"> <strong>Last School Attended</strong>
                        <br>
                        <p class="text-muted">{{ $application->userInfo->last_school_attended }}</p>
                    </div>
                    <div class="col-md-4 col-sm-12"> <strong>Citizenship</strong>
                        <br>
                        <p class="text-muted">{{ optional($application->userInfo->studentType)->student_type }}</p>
                    </div>
                </div>
            </div>
            <!--end::User-->
        </div>
        <!--end::Title-->
    </div>
</div>