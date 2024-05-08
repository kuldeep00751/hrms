<x-base-layout>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="pull-left">
                        <a href="{{ route('admission.applications.filtered') }}" class="btn btn-sm btn-secondary btn-active-light-primary"><i class="fa-solid fa-chevron-left"></i> Applications</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class=" p-5 mb-5 rounded">
                        <h6 class="mb-5 text-gray-400 fw-bold text-uppercase">Student Biographical</h6>
                        <hr>

                        @include('pages/admission/applications/student/_profile-details', ['application' => $application])

                        <h6 class="mb-5 mt-5 text-gray-400 fw-bold text-uppercase">Application Information</h6>
                        <hr>
                        @foreach($applications as $app)

                        <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                            <div class="flex-grow-1">
                                <!--begin::Title-->
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <!--begin::User-->
                                    <div class="d-flex flex-column">

                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 b-r"> <strong>Choice Number</strong>
                                                <br>
                                                <p class="text-muted">{{ $app->choice_number }}</p>
                                            </div>
                                            <div class="col-md-4 col-sm-12 b-r"> <strong>Academic Year</strong>
                                                <br>
                                                <p class="text-muted">{{ $app->academicYear->name }}</p>
                                            </div>
                                            <div class="col-md-4 col-sm-12 b-r"> <strong>Application Type</strong>
                                                <br>
                                                <p class="text-muted">{{ $app->applicationType->application_type }}</p>
                                            </div>
                                            <div class="col-md-4 col-sm-12 b-r"> <strong>Academic Intake</strong>
                                                <br>
                                                <p class="text-muted">{{ $app->academicIntake->name }}</p>
                                            </div>
                                            <div class="col-md-4 col-sm-12"> <strong>Qualification</strong>
                                                <br>
                                                <p class="text-muted"> {{ $app->qualification->qualification_name }}</p>
                                            </div>
                                            <div class="col-md-4 col-sm-12"> <strong>Campus</strong>
                                                <br>
                                                <p class="text-muted">{{ $app->campus->name }}</p>
                                            </div>
                                            <div class="col-md-4 col-sm-12"> <strong>Study Mode</strong>
                                                <br>
                                                <p class="text-muted">{{ $app->studyMode->study_mode }}</p>
                                            </div>
                                            <div class="col-md-4 col-sm-12"> <strong>Application Status</strong>
                                                <br>
                                                <p class="text-muted">{{ $app->application_status }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Title-->
                            </div>
                        </div>
                        @endforeach

                        <h6 class="mb-5 text-gray-400 fw-bold text-uppercase">Documents</h6>
                        <hr>

                        <table class="table table-hover">
                            <thead>
                                <tr class="text-gray-400 fw-bold text-uppercase">
                                    <th></th>
                                    <th class="text-center">Download Document</th>

                                </tr>
                            </thead>
                            @forelse($userInfo->documents as $document)
                            <tr>
                                <td style="width: 50%">
                                    {{ $document->requiredDocument->document_name}}
                                </td>
                                <td class="text-center" style="width: 50%">
                                    <a class="me-5 btn-outline-primary" href="#" onclick="openDocument({{$document->id}}, '{{$document->requiredDocument->document_name}}')">
                                        <i class="fas fa-eye text-primary fs-4"></i>
                                    </a>
                                    <a class="me-5 btn-outline-success" href="{{ route('admission.application.download', $document->id) }}">
                                        <i class="fas fa-download text-success fs-4"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <div class="alert alert-info">
                                No documents have been uploaded.
                            </div>
                            @endforelse
                        </table>

                    </div>
                    <div class="separator separator-dashed mx-5 my-5"></div>
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
                                    @include('pages/admission/applications/student/_nok-section', ['application' => $application])
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
                                    @include('pages/admission/applications/student/_school-leaving-information', ['application' => $application])
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
                                    @include('pages/admission/applications/student/_previous-qualification-section', ['application' => $application])
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
                                    @include('pages/admission/applications/student/_employment', ['application' => $application])
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
                                    @include('pages/admission/applications/student/_health-questionnaire', ['application' => $application])
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
                <h5 class="card-title mb-3"><strong>Process Application</strong></h5>
                <div class="bg-white p-5 shadow rounded">
                    <form class="form-horizontal" method="post" action="{{ route('admission.application.process') }}" onsubmit="event.preventDefault(); processApplication();" id="process-application-form">
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
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id}}" />
                        <input type="hidden" name="application_id" value="{{ $application->id }}" />

                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-12 fw-bold">{{ __('Admission Status:') }}</label>
                            <!--end::Label-->

                            <!--begin::Col-->
                            <div class="col-lg-12 fv-row">
                                <select class="form-control" id="admission_status_id" name="admission_status_id" required>
                                    <option value="" style="display: none;" {{ old('application_status', optional($application)->admission_status_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select admission status</option>
                                    @foreach ($admission_statuses as $key => $admission_status)
                                    <option data-admission="{{ $admission_status->full_admission }}" value="{{ $admission_status->id }}" {{ old('admission_status_id') == $admission_status->id ? 'selected' : '' }}>
                                        {{ $admission_status->status }}
                                    </option>
                                    @endforeach
                                </select>

                                {!! $errors->first('application_status', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-12 fw-bold">{{ __('Remarks: ') }}</label>
                            <!--end::Label-->

                            <!--begin::Col-->
                            <div class="col-lg-12 fv-row">
                                <textarea name="remark" class="form-control form-control-solid" placeholder="{{ __('Type your remarks/notes here')}}">{{old('remark')}}</textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary btn-sm col-md-12">
                                {{ __('Process Application') }}
                            </button>
                        </div>
                    </form>
                </div>
                @if($fullAdmission)
                <div class="row mt-5">
                    <h5 class="card-title mb-3"><strong>Student Registration</strong></h5>
                    <div class="bg-white p-5 shadow rounded">
                        <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                            <div class="flex-grow-1">
                                <!--begin::Title-->
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <!--begin::User-->
                                    <div class="d-flex flex-column">
                                        <form class="form-horizontal" method="post" action="{{ route('admission.application.register') }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="user_id" value="{{ auth()->user()->id}}" />
                                            <input type="hidden" name="application_id" value="{{ $application->id }}" />

                                            <div class="row">
                                                <div class="col-md-6 col-sm-12 b-r"> <strong>Course</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $application->qualification->qualification_name }}</p>
                                                </div>
                                                <div class="col-md-6 col-sm-12 b-r"> <strong>Academic Year</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $application->academicYear->name }}</p>
                                                </div>
                                                <div class="col-md-6 col-sm-12 b-r"> <strong>Academic Intake</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $application->academicIntake->name }}</p>
                                                </div>
                                                <div class="col-md-6 col-sm-12 b-r"> <strong>Campus</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $application->campus->name }}</p>
                                                </div>

                                            </div>
                                            <hr>
                                            <div class="pull-right">
                                                <button type="submit" class="btn btn-success btn-sm col-md-12">
                                                    {{ __('Register Student') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Title-->
                            </div>
                        </div>
                    </div>
                </div>
                @endif

            </div>

        </div>
    </div>

    <script>
        function processApplication() {
            let admissionStatus = document.getElementById('admission_status_id');

            const fullAdmission = admissionStatus.options[admissionStatus.selectedIndex].dataset.admission;
            if (fullAdmission == 1) {
                Swal.fire({
                    title: 'Are you sure you want to fully admit this student? Giving full admission will allow student to be registered.',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    denyButtonText: `No`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        document.getElementById("process-application-form").submit();

                    } else if (result.isDenied) {
                        Swal.fire('Okay, application not processed', '', 'info')
                    }
                })
            } else {
                document.getElementById("process-application-form").submit();
            }

        }

        function openDocument(documentId, documentName) {
            var width = "1000px"; // Get the screen width

            let params = `width=${width},height=800px,left=100,top=100`;

            window.open(`/admission/applications/display/${documentId}`, `${documentName}`, params);
        };
    </script>
</x-base-layout>