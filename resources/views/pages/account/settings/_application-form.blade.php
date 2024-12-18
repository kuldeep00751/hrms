<!--begin::Basic info-->
<!--begin::Content-->
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
            <select class="form-control" id="study_mode_id" name="study_mode_id" required>
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
            <select class="form-control" id="campus_id" name="campus_id" required>
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
    <div class="separator separator-dashed mx-5 my-5"></div>
    <div class="col-lg-2 p-3">
        <button type="button" class="btn btn-sm btn-light-danger btn-delete-application"> <i class="fa-solid fa-trash"></i> Delete </button>
    </div>
</div>
<!--end::Content-->
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