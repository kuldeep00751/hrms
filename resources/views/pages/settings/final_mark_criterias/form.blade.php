<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('module_id') ? 'has-error' : '' }}">
            <label for="module_id" class="control-label">Module <span class="text-danger">*</span></label>

            <select class="form-control grading-parameter" id="module_id" name="module_id" data-control="select2" @if($operation=='edit' ) disabled @endif required>
                <option value="" style="display: none;" {{ old('module_id', optional($finalMarkCriteria)->module_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select module</option>
                @foreach ($modules as $key => $module)
                <option value="{{ $key }}" {{ old('module_id', optional($finalMarkCriteria)->module_id) == $key ? 'selected' : '' }}>
                    {{ $module }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('module_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('academic_year_id') ? 'has-error' : '' }}">
            <label for="academic_year_id" class="control-label">Academic Year <span class="text-danger">*</span></label>

            <select class="form-control grading-parameter" id="academic_year_id" name="academic_year_id" @if($operation=='edit' ) disabled @endif required>
                <option value="" style="display: none;" {{ old('academic_year_id', optional($finalMarkCriteria)->academic_year_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select academic year</option>
                @foreach ($academicYears as $key => $academicYear)
                <option value="{{ $key }}" {{ old('academic_year_id', optional($finalMarkCriteria)->academic_year_id) == $key ? 'selected' : '' }}>
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
        <div class="form-group {{ $errors->has('assessment_type_id') ? 'has-error' : '' }}">
            <label for="assessment_type_id" class="control-label">Exam Type <span class="text-danger">*</span></label>

            <select class="form-control grading-parameter" id="assessment_type_id" name="assessment_type_id" @if($operation=='edit' ) disabled @endif required>
                <option value="" style="display: none;" {{ old('assessment_type_id', optional($finalMarkCriteria)->assessment_type_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select Exam Type</option>
                @foreach ($assessmentTypes as $key => $assessmentType)
                <option value="{{ $key }}" {{ old('assessment_type_id', optional($finalMarkCriteria)->assessment_type_id) == $key ? 'selected' : '' }}>
                    {{ $assessmentType }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('assessment_type_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">

        <table class="table table-row-dashed">
            <thead>
                <tr class="text-start text-gray-400 fw-bold text-uppercase">
                    <th>Mark Range From</th>
                    <th>Mark Range To</th>
                    <th>Result</th>
                    <th></th>
                </tr>
            </thead>
            @if($operation == 'create')
            <tbody id="criteria-table">
                <tr>

                </tr>
            </tbody>

            @else
            <tbody id="criteria-table">
                @foreach($finalMarkCriterias as $finalMarkCriteria)
                <tr>
                    <td class="align-middle">
                        <input class="form-control" name="min_mark[]" type="number" value="{{ $finalMarkCriteria->min_mark }}" placeholder="0.0" required>
                    </td>
                    <td class="align-middle">
                        <input class="form-control" name="max_mark[]" type="number" value="{{ $finalMarkCriteria->max_mark }}" placeholder="0.0" required>
                    </td>
                    <td class="align-middle">
                        <select class="form-control" name="assessment_result_code_id[]" required>
                            <option value="" style="display: none;" {{ old('assessment_result_code_id', optional($finalMarkCriteria)->assessment_result_code_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select result code</option>
                            @foreach ($assessmentResultCodes as $key => $assessmentResultCode)
                            <option value="{{ $key }}" {{ $finalMarkCriteria->assessment_result_code_id == $key ? 'selected' : '' }}>
                                {{ $assessmentResultCode }}
                            </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <button type="button" class="btn btn-light-danger remove-criteria"> <i class="fa-solid fa-times"></i> </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
            @endif
        </table>
        <button class="btn btn-sm btn-primary" type="button" id="addGradingScale">
            <i class="fa-solid fa-plus"></i> Add Grading Scale
        </button>
    </div>
</div>

<script type="text/javascript">
    let addGradingScaleBtn = document.getElementById('addGradingScale');

    addGradingScaleBtn.addEventListener('click', function() {

        const url = `/get-result-codes`;

        const response = fetch(url, {
                method: "GET",
            })
            .then((response) => response.text())
            .then((data) => {

                $("#criteria-table").append(data)
            })
    });

    document.addEventListener("click", function(e) {
        const target = e.target.closest(".remove-paper"); // Or any other selector.

        if (target) {

            Swal.fire({
                title: "Are you sure you want to remove this Paper?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, I am sure",
            }).then((result) => {
                if (result.isConfirmed) {
                    let td = target.parentNode;
                    let tr = td.parentNode; // the row to be removed
                    tr.parentNode.removeChild(tr);
                }
            });
        }
    });
</script>