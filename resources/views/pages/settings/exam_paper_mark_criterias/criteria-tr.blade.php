@if(count($examPapers))
<tr>
    <td class="align-middle">
        <select class="form-control" name="exam_paper_id[]" required>
            <option value="" style="display: none;" disabled selected>Select paper</option>
            @foreach($examPapers as $examPaper)
            <option value="{{ $examPaper->id }}">
                {{ $examPaper->paper_name }}
            </option>
            @endforeach
        </select>
    </td>
    <td class="align-middle">
        <input class="form-control" name="range_from[]" type="number" minlength="1" maxlength="255" placeholder="0.0" required>
    </td>
    <td class="align-middle">
        <input class="form-control" name="range_to[]" type="number" minlength="1" maxlength="255" placeholder="0.0" required>
    </td>
    <td class="align-middle">
                <select class="form-control" name="assessment_result_code_id[]" required>
                    <option value="" style="display: none;" {{ old('assessment_result_code_id', optional($examPaper)->assessment_result_code_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select result code</option>
                    @foreach ($assessmentResultCodes as $key => $assessmentResultCode)
                    <option value="{{ $key }}" {{ old('assessment_result_code_id', optional($assessmentResultCode)->assessment_result_code_id) == $key ? 'selected' : '' }}>
                        {{ $assessmentResultCode }}
                    </option>
                    @endforeach
                </select>
    </td>
    <td>
        <button type="button" class="btn btn-light-danger remove-criteria"> <i class="fa-solid fa-times"></i> </button>
    </td>
</tr>
@else
<tr>
    <td colspan="4">
        <div class="alert alert-danger">
            No exam papers defined for the selected <strong>Module</strong>, <strong>Academic Year</strong> and <strong>Exam Type</strong> combination above.
        </div>
    </td>
</tr>
@endif