<!--begin::Basic info-->
<div class="card {{ $class }}">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{ __('Qualification Application') }}</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->

    <!--begin::Content-->
    <div class="card-body border-top p-9">
        <div id="application-container" class="collapse show">
            <!--begin::Card body-->
            <h6>Submitted Application(s)</h6>
            <div class="p-5 mb-5 border-dashed">
                <div class="table-responsive">
                    <table class="table table-row-dashed">
                        <thead>
                            <tr class="text-gray-400 fw-bold text-uppercase">
                                <th nowrap class="text-center">Choice</th>
                                <th nowrap>Intake</th>
                                <th nowrap>Qualification</th>
                                <th nowrap>Study Mode</th>
                                <th nowrap>Campus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($applications as $application)
                            <tr>
                                <td class="text-center">{{$application->choice_number}}</td>
                                <td>{{$application->academicIntake->name}}</td>
                                <td>{{$application->qualification->qualification_name}}</td>
                                <td>{{$application->studyMode->study_mode}}</td>
                                <td>{{$application->campus->name}}</td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    <div class="alert alert-info">
                                        You currently do not have any application submitted for this academic year. Please use the form below to submit a new application.
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if(count($applicationAcademicProcess) > 0)

            @if(count($applications))
            @else
            <div class="p-5 mb-5 border-dashed">

                <div class="row mb-3">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Please select the academic year:') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input class="form-control" name="choice_number" type="hidden" id="choice_number" value="{{ old('choice_number', $choice_number) }}" minlength="1" placeholder="Enter number of credits here..." readonly="readonly">
                        @if(count($applicationAcademicProcess) > 0)
                        <select name="academic_year_id" aria-label="{{ __('Select') }}" data-placeholder="{{ __('Select...') }}" class="form-select form-select-solid form-select-lg fw-bold" required data-label="Academic Year">
                            <option value="" style="display: none;" disabled selected>Select</option>
                            @foreach ($applicationAcademicProcess as $key => $applicationProcess)
                            <option value="{{ $applicationProcess->academic_year_id }}">
                                {{ $applicationProcess->academicYear->name }}
                            </option>
                            @endforeach
                        </select>
                        @else
                        <p class="text-danger">
                            No active academic year for you to apply into. Please contact the institution for assistance.
                        </p>
                        @endif
                    </div>
                    <!--end::Col-->

                </div>

                <div class="row mb-3">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('When would you like to start?') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        @if(count($applicationAcademicProcess) > 0)
                        <select name="academic_intake_id" aria-label="{{ __('Select') }}" data-placeholder="{{ __('Select...') }}" class="form-select form-select-solid form-select-lg fw-bold" required data-label="Academic Intake">
                            <option value="" style="display: none;" disabled selected>Select</option>
                            @foreach ($applicationAcademicProcess as $key => $applicationProcess)
                            <option value="{{ $applicationProcess->academic_intake_id }}">
                                {{ $applicationProcess->academicIntake->name }}
                            </option>
                            @endforeach
                        </select>
                        @else
                        <p class="text-danger">
                            No active academic intake for you to apply into. Please contact the institution for assistance.
                        </p>
                        @endif
                    </div>
                    <!--end::Col-->

                </div>

                <div class="row mb-3">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Qualification') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <select name="qualification_id" id="qualification_id" aria-label="{{ __('Select') }}" data-placeholder="{{ __('Select...') }}" data-control="select2" class="form-select form-select-solid form-select-lg fw-bold" onchange="getQualificationData(this)">
                            <option value="" style="display: none;" disabled selected>Select</option>
                            @foreach ($qualifications as $key => $qualification)
                            <option value="{{ $key }}">
                                {{ $qualification }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!--end::Col-->
                <div class="row mb-3">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('How would you like to study?') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <select class="form-control" id="study_mode_id" name="study_mode_id" required data-label="Study Mode">
                            <option value="" style="display: none;" disabled selected>Select study mode</option>
                            @foreach ($studyModes as $key => $studyMode)
                            <option value="{{ $key }}">
                                {{ $studyMode }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <!--end::Col-->

                </div>

                <div class="row mb-3">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Where would you like to study?') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <select class="form-control" id="campus_id" name="campus_id" required data-label="Campus">
                            <option value="" style="display: none;" disabled selected>Select campus</option>
                            @foreach ($campuses as $key => $campus)
                            <option value="{{ $key }}">
                                {{ $campus }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <!--end::Col-->

                </div>
            </div>
            @endif
            @else
            <div class="alert alert-danger">
                <p>We are currently not accepting applications. Please check in again later.</p>
            </div>
            @endif
            <!--end::Card body-->
        </div>
        @if($allowApplicatioNSubmission)
        <div class="row">
            <div class="col-lg-4">
                <button type="button" id="btn-add-application" class="btn btn-primary btn-sm" data-id="{{$info->id}}"><i class="fa-solid fa-plus"></i> Add Another Choice </button>
            </div>
        </div>
        @endif
    </div>

    <!--end::Content-->
</div>
<!--end::Basic info-->

<script>
    async function getQualificationData(qualification) {
        const url = "/get-qualification-data/" + qualification.value;

        const response = await fetch(url, {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                },
            })
            .then((response) => response.json())
            .then((data) => {
                const studyModes = data.studyModes;

                const campuses = data.campuses;

                const campusOptions = document.getElementById("campus_id");

                let campusOption = '<option value="" style="display: none;" disabled selected>Select</option>';

                for (let id in campuses) {
                    campusOption += `<option value="${id}">${campuses[id]}</option>`;
                }
                campusOptions.innerHTML = campusOption;

                const studyModeOptions = document.getElementById("study_mode_id");

                let studyModeOption = '<option value="" style="display: none;" disabled selected>Select</option>';

                for (let id in studyModes) {
                    studyModeOption += `<option value="${id}">${studyModes[id]}</option>`;
                }

                studyModeOptions.innerHTML = studyModeOption;

            })
    }
</script>