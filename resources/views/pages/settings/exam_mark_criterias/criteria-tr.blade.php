<tr>
    <td class="align-middle">
        <input class="form-control" name="min_mark[]" type="number" minlength="1" maxlength="255" placeholder="0.0" required>
    </td>
    <td class="align-middle">
        <input class="form-control" name="max_mark[]" type="number" minlength="1" maxlength="255" placeholder="0.0" required>
    </td>
    <td class="align-middle">
        <select class="form-control" name="assessment_result_code_id[]" required>
            <option value="" style="display: none;" disabled selected>Select result code</option>
            @foreach ($assessmentResultCodes as $key => $assessmentResultCode)
            <option value="{{ $key }}">
                {{ $assessmentResultCode }}
            </option>
            @endforeach
        </select>
    </td>
    <td>
        <button type="button" class="btn btn-light-danger remove-criteria"> <i class="fa-solid fa-times"></i> </button>
    </td>
</tr>