<x-base-layout>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="pull-left">
                        <a href="{{ route('registration.qualification.index') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Registrations</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class=" p-5 mb-5 rounded">
                        <h6 class="mb-5">Student Information</h6>
                        <hr>

                        @include('pages/admission/applications/student/_profile-details', ['application' => $registration->application])
                        <h6 class="mb-5 mt-5">Application Information</h6>
                        <hr>

                        <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                            <div class="flex-grow-1">
                                <!--begin::Title-->
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <!--begin::User-->
                                    <div class="d-flex flex-column">

                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 b-r"> <strong>Choice Number</strong>
                                                <br>
                                                <p class="text-muted">{{ $registration->application->choice_number }}</p>
                                            </div>
                                            <div class="col-md-4 col-sm-12 b-r"> <strong>Academic Year</strong>
                                                <br>
                                                <p class="text-muted">{{ $registration->application->academicYear->name }}</p>
                                            </div>

                                            <div class="col-md-4 col-sm-12 b-r"> <strong>Academic Intake</strong>
                                                <br>
                                                <p class="text-muted">{{ $registration->application->academicIntake->name }}</p>
                                            </div>
                                            <div class="col-md-4 col-sm-12"> <strong>Qualification</strong>
                                                <br>
                                                <p class="text-muted"> {{ $registration->application->qualification->qualification_name }}</p>
                                            </div>
                                            <div class="col-md-4 col-sm-12"> <strong>Campus</strong>
                                                <br>
                                                <p class="text-muted">{{ $registration->application->campus->name }}</p>
                                            </div>
                                            <div class="col-md-4 col-sm-12"> <strong>Study Mode</strong>
                                                <br>
                                                <p class="text-muted">{{ $registration->application->studyMode->study_mode }}</p>
                                            </div>

                                        </div>
                                    </div>
                                    <!--end::User-->
                                </div>

                            </div>
                        </div>

                    </div>
                    <!--begin::Accordion-->
                    <div class="accordion" id="kt_accordion_1">

                        <div class="accordion-item ">
                            <h2 class="accordion-header" id="guardian_information_header">
                                <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#guardian_information_body" aria-expanded="false" aria-controls="guardian_information_body">
                                    Guardian / Next of Kin Information
                                </button>
                            </h2>
                            <div id="guardian_information_body" class="accordion-collapse collapse" aria-labelledby="guardian_information_header" data-bs-parent="#kt_accordion_1">
                                <div class="accordion-body">
                                    @include('pages/admission/applications/student/_nok-section', ['application' => $registration->application])
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item ">
                            <h2 class="accordion-header" id="secondary_school_header">
                                <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#secondary_school_body" aria-expanded="false" aria-controls="secondary_school_body">
                                    Secondary School Information
                                </button>
                            </h2>
                            <div id="secondary_school_body" class="accordion-collapse collapse" aria-labelledby="secondary_school_header" data-bs-parent="#kt_accordion_1">
                                <div class="accordion-body">
                                    @include('pages/admission/applications/student/_school-leaving-information', ['application' => $registration->application])
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item ">
                            <h2 class="accordion-header" id="previous_qualifications_header">
                                <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#previous_qualification_body" aria-expanded="false" aria-controls="previous_qualification_body">
                                    Previous Qualification
                                </button>
                            </h2>
                            <div id="previous_qualification_body" class="accordion-collapse collapse" aria-labelledby="previous_qualifications_header" data-bs-parent="#kt_accordion_1">
                                <div class="accordion-body">
                                    @include('pages/admission/applications/student/_previous-qualification-section', ['application' => $registration->application])
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item ">
                            <h2 class="accordion-header" id="employment_details">
                                <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#employment_details_body" aria-expanded="false" aria-controls="employment_details_body">
                                    Employment Details
                                </button>
                            </h2>
                            <div id="employment_details_body" class="accordion-collapse collapse" aria-labelledby="employment_details" data-bs-parent="#kt_accordion_1">
                                <div class="accordion-body">
                                    @include('pages/admission/applications/student/_employment', ['application' => $registration->application])
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item ">
                            <h2 class="accordion-header" id="health_questionnaire_header">
                                <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#health_questionnaire_body" aria-expanded="false" aria-controls="health_questionnaire_body">
                                    Health Questionnaire
                                </button>
                            </h2>
                            <div id="health_questionnaire_body" class="accordion-collapse collapse" aria-labelledby="health_questionnaire_header" data-bs-parent="#kt_accordion_1">
                                <div class="accordion-body">
                                    @include('pages/admission/applications/student/_health-questionnaire', ['application' => $registration->application])
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Accordion-->
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="mb-5 bd-toc mt-5 my-md-0 ps-xl-3 mb-lg-5 text-muted">
                <h5 class="card-title mb-3"><strong>Process Student Registration</strong></h5>
                <div class="bg-white p-5 shadow rounded">
                    <form class="form-horizontal" method="post" action="{{ route('register.qualification') }}">
                        @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        @endif

                        @if(Session::has('success_message'))
                        <div class="alert alert-success">
                            <h6 class="text-success">
                                <i class="fa-solid fa-circle-check text-success"></i>
                                {!! session('success_message') !!}
                            </h6>
                        </div>
                        @endif

                        {{ csrf_field() }}
                        <input type="hidden" name="registration_id" value="{{ $registration->id}}" />
                        <input type="hidden" name="created_by" value="{{ auth()->user()->id}}" />


                        <button type="submit" class="btn btn-primary btn-sm" name="register" value="register">
                            {{ __('Register Student') }}
                        </button>
                        @if(!$registration->promotion_status)
                        <a href="/promotion/filter?student_number={{ $registration->userInfo->student_number}}" class="btn btn-sm btn-warning btn-active-light-primary">
                            Promote
                        </a>
                        @endif
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-base-layout>