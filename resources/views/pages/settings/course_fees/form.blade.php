<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('module_id') ? 'has-error' : '' }}">
            <label for="qualification_id" class="control-label">Qualification <span class="text-danger">*</span></label>

            <select class="form-control" id="qualification_id" name="qualification_id" data-control="select2" required>
                <option value="" style="display: none;" {{ old('qualification_id', optional($courseFee)->qualification_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select qualification</option>
                @foreach ($qualifications as $key => $qualification)
                <option value="{{ $key }}" {{ old('qualification_id', optional($courseFee)->qualification_id) == $key ? 'selected' : '' }}>
                    {{ $qualification }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('qualification_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('year_level_id') ? 'has-error' : '' }}">
            <label for="year_level_id" class="control-label">Year Level <span class="text-danger">*</span></label>

            <select class="form-control" id="year_level_id" name="year_level_id" required>
                <option value="" style="display: none;" {{ old('year_level_id', optional($courseFee)->year_level_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select year level</option>
                @foreach ($yearLevels as $key => $yearLevel)
                <option value="{{ $key }}" {{ old('year_level_id', optional($courseFee)->year_level_id) == $key ? 'selected' : '' }}>
                    {{ $yearLevel }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('year_level_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('academic_year_id') ? 'has-error' : '' }}">
            <label for="academic_year_id" class="control-label">Academic Year <span class="text-danger">*</span></label>

            <select class="form-control" id="academic_year_id" name="academic_year_id" required>
                <option value="" style="display: none;" {{ old('academic_year_id', optional($courseFee)->academic_year_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select academic year</option>
                @foreach ($academicYears as $key => $academicYear)
                <option value="{{ $key }}" {{ old('academic_year_id', optional($courseFee)->academic_year_id) == $key ? 'selected' : '' }}>
                    {{ $academicYear }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('academic_year_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('student_type_id') ? 'has-error' : '' }}">
            <label for="student_type_id" class="control-label">Student type <span class="text-danger">*</span></label>

            <select class="form-control" id="student_type_id" name="student_type_id" required>
                <option value="" style="display: none;" {{ old('student_type_id', optional($courseFee)->student_type_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select student type</option>
                @foreach ($studentTypes as $key => $studentType)
                <option value="{{ $key }}" {{ old('student_type_id', optional($courseFee)->student_type_id) == $key ? 'selected' : '' }}>
                    {{ $studentType }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('student_type_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('academic_process') ? 'has-error' : '' }}">
            <label for="academic_process" class="control-label">Academic Process <span class="text-danger">*</span></label>
            <input class="form-control" name="academic_process" type="text" id="academic_process" value="Registration" readonly>
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
            <label for="amount" class="control-label">Course Fee (N$) <span class="text-danger">*</span></label>
            <input class="form-control" name="amount" type="number" id="amount" value="{{ old('amount', optional($courseFee)->amount) }}">
            <input class="form-control" name="created_by" type="hidden" id="created_by" value="{{ auth()->user()->id }}">
        </div>
    </div>
</div>

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