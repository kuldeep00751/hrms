<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('fee_type_id') ? 'has-error' : '' }}">
            <label for="fee_type_id" class="control-label">Fee Type <span class="text-danger">*</span></label>

            <select class="form-control" id="fee_type" name="fee_type_id" required>
                <option value="" style="display: none;" {{ old('fee_type_id', optional($otherFee)->fee_type_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select fee type</option>
                @foreach ($feeTypes as $key => $feeType)
                <option value="{{ $key }}" {{ old('fee_type_id', optional($otherFee)->fee_type_id) == $key ? 'selected' : '' }}>
                    {{ $feeType }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('fee_type_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('academic_year_id') ? 'has-error' : '' }}">
            <label for="academic_year_id" class="control-label">Academic Year <span class="text-danger">*</span></label>

            <select class="form-control" id="academic_year_id" name="academic_year_id" required>
                <option value="" style="display: none;" {{ old('academic_year_id', optional($otherFee)->academic_year_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select academic year</option>
                @foreach ($academicYears as $key => $academicYear)
                <option value="{{ $key }}" {{ old('academic_year_id', optional($otherFee)->academic_year_id) == $key ? 'selected' : '' }}>
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
        <div class="form-group {{ $errors->has('qualification_id') ? 'has-error' : '' }}">
            <label for="qualification_id" class="control-label">Qualification <span class="text-danger">*</span></label>

            <select class="form-control" id="qualification_id" name="qualification_id[]" required multiple>
                <option value="" style="display: none;" {{ old('qualification_id', optional($otherFee)->qualification_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select qualifications</option>
                @foreach ($qualifications as $key => $qualification)
                <option value="{{ $key }}" {{ old('qualification_id', optional($otherFee)->qualification_id) == $key ? 'selected' : '' }}>
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
                <option value="" style="display: none;" {{ old('year_level_id', optional($otherFee)->year_level_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select year level</option>
                @foreach ($yearLevels as $key => $yearLevel)
                <option value="{{ $key }}" {{ old('year_level_id', optional($otherFee)->year_level_id) == $key ? 'selected' : '' }}>
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
        <div class="form-group {{ $errors->has('student_type_id') ? 'has-error' : '' }}">
            <label for="student_type_id" class="control-label">Student type <span class="text-danger">*</span></label>

            <select class="form-control" id="student_type_id" name="student_type_id" required>
                <option value="" style="display: none;" {{ old('student_type_id', optional($otherFee)->student_type_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select student type</option>
                @foreach ($studentTypes as $key => $studentType)
                <option value="{{ $key }}" {{ old('student_type_id', optional($otherFee)->student_type_id) == $key ? 'selected' : '' }}>
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
            <select class="form-control" id="academic_process" name="academic_process" required>
                <option value="" style="display: none;" {{ old('academic_process', optional($otherFee)->academic_process ?: '') == '' ? 'selected' : '' }} disabled selected>Select academic process</option>
                @foreach(\App\Core\Data::getAcademicProcesses() as $key => $value)
                <option value="{{ $key }}" {{ $key === old('academic_process', optional($otherFee)->academic_process ?? '') ? 'selected' :'' }}>{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
            <label for="amount" class="control-label">Amount (N$) <span class="text-danger">*</span></label>
            <input class="form-control" name="amount" type="number" id="amount" value="{{ old('amount', optional($otherFee)->amount) }}">
            <input class="form-control" name="created_by" type="hidden" id="created_by" value="{{ auth()->user()->id }}">
        </div>
    </div>
</div>