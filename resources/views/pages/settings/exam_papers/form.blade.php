<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('module_id') ? 'has-error' : '' }}">
            <label for="module_id" class="control-label">Module <span class="text-danger">*</span></label>

            <select class="form-control" id="module_id" name="module_id" data-control="select2" required>
                <option value="" style="display: none;" {{ old('module_id', optional($examPaper)->module_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select module</option>
                @foreach ($modules as $key => $module)
                <option value="{{ $key }}" {{ old('module_id', optional($examPaper)->module_id) == $key ? 'selected' : '' }}>
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

            <select class="form-control" id="academic_year_id" name="academic_year_id" required>
                <option value="" style="display: none;" {{ old('academic_year_id', optional($examPaper)->academic_year_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select academic year</option>
                @foreach ($academicYears as $key => $academicYear)
                <option value="{{ $key }}" {{ old('academic_year_id', optional($examPaper)->academic_year_id) == $key ? 'selected' : '' }}>
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

            <select class="form-control" id="assessment_type_id" name="assessment_type_id" required>
                <option value="" style="display: none;" {{ old('assessment_type_id', optional($examPaper)->assessment_type_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select Exam Type</option>
                @foreach ($assessmentTypes as $key => $assessmentType)
                <option value="{{ $key }}" {{ old('assessment_type_id', optional($examPaper)->assessment_type_id) == $key ? 'selected' : '' }}>
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
        <div class="form-group {{ $errors->has('assessment_result_code_id') ? 'has-error' : '' }}">
            <label for="assessment_result_code_id" class="control-label">Subminimum Result Code <span class="text-danger">*</span></label>

            <select class="form-control" id="assessment_result_code_id" name="assessment_result_code_id" required>
                <option value="" style="display: none;" {{ old('assessment_result_code_id', optional($examPaper)->assessment_result_code_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select Subminimum Result Code</option>
                @foreach ($assessmentResultCodes as $key => $assessmentResultCode)
                <option value="{{ $key }}" {{ old('assessment_result_code_id', optional($examPaper)->assessment_result_code_id) == $key ? 'selected' : '' }}>
                    {{ $assessmentResultCode }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('assessment_result_code_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="alert alert-warning text-info">
            The weights should add up 100%.
        </div>
        <table class="table table-row-dashed">
            <thead>
                <tr class="text-start text-gray-400 fw-bold text-uppercase">
                    <th>Paper Name</th>
                    <th>Min. Pass Mark</th>
                    <th>Weight (%)</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="weights-table">
                @foreach($examPapers as $paper)
                <tr>
                    <td>
                        <input type="hidden" name="paper[]" value="{{ $paper->id }}">
                        <input class="form-control" name="paper_name[]" type="text" value="{{$paper->paper_name}}" placeholder="Ex. Paper 1, Theory, Practical" required>
                    </td>
                    <td>
                        <input class="form-control" name="minimum_pass_mark[]" type="number" value="{{$paper->minimum_pass_mark}}" minlength="1" maxlength="255" placeholder="0.0" required>
                    </td>
                    <td>
                        <input class="form-control paper-weights" name="weight[]" type="number" minlength="1" value="{{$paper->weight}}" maxlength="255" placeholder="0.0" required>
                    </td>
                    <td>
                        <button type="button" data-id="{{$paper->id}}" class="btn btn-light-danger remove-paper"> <i class="fa-solid fa-times"></i> </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button class="btn btn-sm btn-primary" type="button" id="addExamPaperBtn">
            <i class="fa-solid fa-plus"></i> Add Paper
        </button>
    </div>
</div>

<script type="text/javascript">
    let addExamPaperBtn = document.getElementById('addExamPaperBtn');

    addExamPaperBtn.addEventListener('click', function() {
        let html = `<tr>
                        <td>
                            <input type="hidden" name="paper[]" value="">
                            <input class="form-control" name="paper_name[]" type="text" placeholder="Ex. Paper 1, Theory, Practical" required>
                        </td>
                        <td>
                            <input class="form-control" name="minimum_pass_mark[]" type="number" minlength="1" maxlength="255" placeholder="0.0" required>
                        </td>
                         <td>
                            <input class="form-control" name="weight[]" type="number" minlength="1" maxlength="255" placeholder="0.0" required>
                        </td>
                        <td>
                            <button type="button" data-id="0" class="btn btn-light-danger remove-paper"> <i class="fa-solid fa-times"></i> </button>
                        </td>
                    </tr>`;
        $("#weights-table").append(html)
    })


    document.addEventListener("click", function(e) {
        const paperId = e.target.dataset.id;

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

                    //check if the paper has paper marks captured
                    const url = `/exam_papers/marks-exist/${paperId}`;

                    const response = fetch(url, {
                            method: "GET",
                        })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.status) {
                                let td = target.parentNode;
                                let tr = td.parentNode; // the row to be removed
                                tr.parentNode.removeChild(tr);
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    text: `${data.message}`,
                                })
                            }

                        })
                }
            });
        }
    });
</script>