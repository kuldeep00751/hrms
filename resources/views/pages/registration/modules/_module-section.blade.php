<div class="p-5 mb-5 border-dashed">
    <div class="row mb-5">
        <label class="col-lg-3 col-form-label fw-bold fs-6 text-right required">{{ __('Module') }}</label>
        <select class="form-control" id="module_id" name="module_id" data-control="select2" required>
            <option value="" style="display: none;" disabled selected>Select module</option>
            @foreach ($modules as $key => $module)
            <option value="{{ $key }}">
                {{ $module }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="row mb-5">
        <div class="col-md-6">
            <label class="col-lg-3 col-form-label fw-bold fs-6 text-right required">{{ __('Academic Year') }}</label>
            <select class="form-control" name="academic_year_id[]" required>
                <option value="" style="display: none;" disabled selected>Select academic year</option>
                @foreach ($academicYears as $key => $academicYear)
                <option value="{{ $key }}">
                    {{ $academicYear }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label class="col-lg-3 col-form-label fw-bold fs-6 text-right required">{{ __('Academic Intake') }}</label>
            <select class="form-control" name="academic_intake_id[]" required>
                <option value="" style="display: none;" disabled selected>Select academic intake</option>
                @foreach ($academicIntakes as $key => $academicIntake)
                <option value="{{ $key }}">
                    {{ $academicIntake }}
                </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-6">
            <label class="col-lg-3 col-form-label fw-bold fs-6 text-right required">{{ __('Study Mode') }}</label>
            <select class="form-control" name="study_mode_id[]" required>
                <option value="" style="display: none;" disabled selected>Select study mode</option>
                @foreach ($studyModes as $key => $studyMode)
                <option value="{{ $key }}">
                    {{ $studyMode }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label class="col-lg-3 col-form-label fw-bold fs-6 text-right required">{{ __('Study Period') }}</label>
            <select class="form-control" name="study_period_id[]" required>
                <option value="" style="display: none;" disabled selected>Select study period</option>
                @foreach ($studyPeriods as $key => $studyPeriod)
                <option value="{{ $key }}">
                    {{ $studyPeriod }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
</div>