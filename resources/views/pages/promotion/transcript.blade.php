<div class="table-responsive">
    <table class="table table-bordered" style="border: 1px solid #e6e6ef; padding: 5px;">
        <thead>
            <tr class="fw-bold fs-6 text-gray-800 bg-gray-300" style="border: 1px solid #e6e6ef; padding: 5px;">
                <th>Module</th>
                <th>Module code</th>
                <th>Study Mode</th>
                <th>CA Mark</th>
                <th>Exam Mark</th>
                <th>Final Mark</th>
                <th>Result</th>
                <th>Pass/Fail</th>
                <th>Credits</th>
            </tr>
        </thead>
        @php
        $currentYear = null;
        $yearTotals = [];
        @endphp
        <tbody class="fw-semibold text-gray-600">
            <!--begin::Table row-->
            @foreach($subjectDetails as $subjectDetail)
            @if (!isset($currentYear) || $currentYear != $subjectDetail->academic_year)
            <tr class="bg-gray-200">
                <td class="p-2" colspan="9"><strong>{{ $subjectDetail->academic_year }}</strong></td>
            </tr>
            @php
            $currentYear = $subjectDetail->academic_year;
            $yearTotals[$currentYear] = 0;
            @endphp
            @endif
            <tr style="border: 1px solid #e6e6ef; padding: 5px;">
                <td>{{ $subjectDetail->module_name }}</td>
                <td>{{ $subjectDetail->module_code }}</td>
                <td>{{ $subjectDetail->study_mode }}</td>
                <td>{{ $subjectDetail->ca_mark }}</td>
                <td>{{ $subjectDetail->exam_mark }}</td>
                <td>{{ $subjectDetail->final_mark }}</td>
                <td>{{ $subjectDetail->result_code }} - {{ $subjectDetail->result_code_description }}</td>
                <td>{{ $subjectDetail->pass_fail }}</td>
                <td>
                    @if($subjectDetail->pass_fail == 'P')
                    {{ $subjectDetail->module_credits}}
                    @endif
                </td>
            </tr>
            @php
            if($subjectDetail->pass_fail == 'P'){
            $yearTotals[$currentYear] += $subjectDetail->module_credits;
            }
            @endphp

            @endforeach
            <tr class="bg-gray-200">
                <td class="p-2 text-right" colspan="8">Total Credits for <strong>{{ $currentYear }}</strong></td>
                <td>
                    @if($currentYear)
                    <strong>{{ $yearTotals[$currentYear] }}</strong>
                    @else
                    <strong>0</strong>
                    @endif
                </td>
            </tr>
            <!--end::Table row-->
        </tbody>
    </table>
    <!--end::Table-->
</div>
<div class="separator separator-dashed mx-5 my-5"></div>
<div class="row mb-5">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('year_level_id') ? 'has-error' : '' }}">
            <label for="year_level_id" class="control-label">Year Level <span class="text-danger">*</span></label>

            <select class="form-control" id="year_level_id" name="year_level_id" required>
                <option value="" style="display: none;" {{ old('year_level_id', optional($studentRegistration)->year_level_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select Year Level</option>
                @foreach ($yearLevels as $key => $yearLevel)
                <option value="{{ $key }}" {{ old('year_level', optional($studentRegistration)->year_level_id) == $key ? 'selected' : '' }}>
                    {{ $yearLevel }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('year_level_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('promotion_status_id') ? 'has-error' : '' }}">
            <label for="promotion_status_id" class="control-label">Promotion Status <span class="text-danger">*</span></label>

            <select class="form-control" id="promotion_status_id" name="promotion_status_id" required>
                <option value="" style="display: none;" {{ old('promotion_status_id', optional($studentRegistration)->promotion_status_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select promotion</option>
                @foreach ($promotionStatuses as $key => $promotionStatus)
                <option value="{{ $key }}" {{ old('year_level', optional($studentRegistration)->promotion_status) == $key ? 'selected' : '' }}>
                    {{ $promotionStatus }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('promotion_status_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <input type="hidden" name="user_info_id" value="{{$studentRegistration->user_info_id}}">
    <input type="hidden" name="registration_id" value="{{$studentRegistration->id}}">
    <input type="hidden" name="academic_year" value="{{$studentRegistration->academic_year_id}}">
    <input type="hidden" name="academic_intake" value="{{$studentRegistration->academic_intake_id}}">
    <input type="hidden" name="qualification" value="{{$studentRegistration->qualification_id}}">
    <input type="hidden" name="study_mode" value="{{$studentRegistration->study_mode_id}}">
    <input type="hidden" name="year_level_id" value="{{$studentRegistration->year_level_id}}">
</div>