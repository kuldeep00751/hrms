
<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('module_id') ? 'has-error' : '' }}">
            <label for="module_id" class="control-label">Module <span class="text-danger">*</span></label>

            <select class="form-control grading-parameter" id="module_id" name="module_id" data-control="select2" @if($operation=='edit' ) disabled @endif required>
                <option value="" style="display: none;" {{ old('module_id', optional($examPaperMarkCriteria)->module_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select module</option>
                @foreach ($modules as $key => $module)
                <option value="{{ $key }}" {{ old('module_id', optional($examPaperMarkCriteria)->module_id) == $key ? 'selected' : '' }}>
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
                <option value="" style="display: none;" {{ old('academic_year_id', optional($examPaperMarkCriteria)->academic_year_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select academic year</option>
                @foreach ($academicYears as $key => $academicYear)
                <option value="{{ $key }}" {{ old('academic_year_id', optional($examPaperMarkCriteria)->academic_year_id) == $key ? 'selected' : '' }}>
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
                <option value="" style="display: none;" {{ old('assessment_type_id', optional($examPaperMarkCriteria)->assessment_type_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select Exam Type</option>
                @foreach ($assessmentTypes as $key => $assessmentType)
                <option value="{{ $key }}" {{ old('assessment_type_id', optional($examPaperMarkCriteria)->assessment_type_id) == $key ? 'selected' : '' }}>
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
                    <th>Paper Name</th>
                    <th>Mark Range From</th>
                    <th>Mark Range To</th>
                    <th>Result</th>
                    <th></th>
                </tr>
            </thead>
            @if($operation == 'create')
            <tbody id="criteria-table">
                <tr>
                    <td colspan="4">
                        <div class="alert alert-danger">
                            Please select the <strong>Module</strong>, <strong>Academic Year</strong> and <strong>Exam Type</strong> combination above to be able to set the grading scale.
                        </div>
                    </td>
                </tr>
            </tbody>

            @else
            <tbody id="criteria-table">
                @foreach($examPaperMarkCriterias as $examPaperMarkCriteria)
                <tr>
                    <td class="align-middle">
                        <select class="form-control" name="exam_paper_id[]" required>
                            <option value="" style="display: none;" disabled selected>Select paper</option>
                            @foreach($examPapers as $examPaper)
                            <option value="{{ $examPaper->id }}" {{ $examPaperMarkCriteria->exam_paper_id == $examPaper->id ? 'selected' : '' }}>
                                {{ $examPaper->paper_name }}
                            </option>
                            @endforeach
                        </select>
                    </td>
                    <td class="align-middle">
                        <input class="form-control" name="range_from[]" type="number" value="{{ $examPaperMarkCriteria->range_from }}" placeholder="0.0" required>
                    </td>
                    <td class="align-middle">
                        <input class="form-control" name="range_to[]" type="number" value="{{ $examPaperMarkCriteria->range_to }}" placeholder="0.0" required>
                    </td>
                    <td class="align-middle">
                        <select class="form-control" name="assessment_result_code_id[]" required>
                            <option value="" style="display: none;" {{ old('assessment_result_code_id', optional($examPaper)->assessment_result_code_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select result code</option>
                            @foreach ($assessmentResultCodes as $key => $assessmentResultCode)
                            <option value="{{ $key }}" {{ $examPaperMarkCriteria->assessment_result_code_id == $key ? 'selected' : '' }}>
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
    let gradingParameters = document.querySelectorAll(".grading-parameter");

    gradingParameters.forEach(function(parameter) {

        parameter.addEventListener('change', function(event) {
            let moduleId = document.getElementById('module_id').value;
            let assessmentTypeId = document.getElementById('assessment_type_id').value;
            let academicYearId = document.getElementById('academic_year_id').value;

            let requestParameters = {
                'module_id': moduleId,
                'assessment_type_id': assessmentTypeId,
                'academic_year_id': academicYearId,
            }


            if (moduleId != 0 && assessmentTypeId != 0 && academicYearId != 0) {
                getModulePapers(requestParameters)
            } else {
                let html = ` <tr>
                                <td colspan="4">
                                    <div class="alert alert-danger">
                                        Please select the <strong>Module</strong>, <strong>Academic Year</strong> and <strong>Exam Type</strong> combination above to be able to set the grading scale.
                                    </div>
                                </td>
                            </tr>`;
                $("#criteria-table").html(html)
            }
        })
    })

    let addGradingScaleBtn = document.getElementById('addGradingScale');

    addGradingScaleBtn.addEventListener('click', function() {
        let moduleId = document.getElementById('module_id').value;
        let assessmentTypeId = document.getElementById('assessment_type_id').value;
        let academicYearId = document.getElementById('academic_year_id').value;

        let requestParameters = {
            'module_id': moduleId,
            'assessment_type_id': assessmentTypeId,
            'academic_year_id': academicYearId,
        }


        if ((moduleId != 0) && (assessmentTypeId != 0) && (academicYearId != 0)) {
            const url = `/get-module-papers/${requestParameters.module_id}/${requestParameters.assessment_type_id}/${requestParameters.academic_year_id}`;

            const response = fetch(url, {
                    method: "GET",
                })
                .then((response) => response.text())
                .then((data) => {

                    $("#criteria-table").append(data)
                })
        } else {
            let html = ` <tr>
                                <td colspan="4">
                                    <div class="alert alert-danger">
                                        Please select the <strong>Module</strong>, <strong>Academic Year</strong> and <strong>Exam Type</strong> combination above to be able to set the grading scale.
                                    </div>
                                </td>
                            </tr>`;
            $("#criteria-table").html(html)
        }

    });



    async function getModulePapers(requestParameters) {
        const url = `/get-module-papers/${requestParameters.module_id}/${requestParameters.assessment_type_id}/${requestParameters.academic_year_id}`;

        const response = await fetch(url, {
                method: "GET",
            })
            .then((response) => response.text())
            .then((data) => {

                $("#criteria-table").html(data)
            })
    }



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