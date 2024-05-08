<tr>
    <td>
        <select name="mark_type_id[]" aria-label="{{ __('MarkType') }}" data-placeholder="{{ __('Select mark type...') }}" class="form-select form-select-solid fw-bold">
            <option value="" style="display: none;" disabled selected>Select Mark Type</option>
            @foreach ($markTypes as $markType)
            <option value="{{ $markType->id }}">
                {{ $markType->mark_type }}
            </option>
            @endforeach
        </select>
        <input type="hidden" name="continuous_assessment_weight_id[]" value="">
    </td>
    <td>
        <input class="form-control" name="assessment_description[]" type="text" placeholder="Ex. Assignment 1, Test 1">
    </td>
    <td>
        <input class="form-control" name="weight[]" type="number" minlength="1" maxlength="255" placeholder="0.0">
    </td>
    <td>
        <button type="button" class="btn btn-light-danger remove-assessment-type"> <i class="fa-solid fa-times"></i> </button>
    </td>
</tr>