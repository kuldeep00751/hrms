<tr>
    <td style="width: 30%;">
        <select name="school_subject_id[]" aria-label="{{ __('Select your subject') }}" data-placeholder="{{ __('Select your subject...') }}" class="form-select form-select-solid fw-bold">
            <option value="">{{ __('Select your subject...') }}</option>
            @foreach($schoolSubjects as $key => $value)
            <option value="{{ $key }}" {{ $key === old('school_subject_id', $info->school_subject_id ?? '') ? 'selected' :'' }}>{{ $value }}</option>
            @endforeach
        </select>
    </td>
    <td style="width: 20%;">
        <select name="matric_type[]" aria-label="{{ __('Select your level') }}" data-placeholder="{{ __('Select your level...') }}" class="form-select form-select-solid fw-bold matric_types">
            <option value="">{{ __('Select your level...') }}</option>
            @foreach($matricTypes as $key => $value)
            <option value="{{ $key }}" {{ $key === old('matric_type', $info->matric_type ?? '') ? 'selected' :'' }}>{{ $value }}</option>
            @endforeach
        </select>
    </td>
    <td style="width: 20%;">
        <select name="mid_term_result[]" aria-label="{{ __('Select your symbol') }}" data-placeholder="{{ __('Select your symbol...') }}" class="form-select form-select-solid fw-bold mid_term_results">
            <option value="">{{ __('Select your symbol...') }}</option>

        </select>
        <input type="hidden" class="mid_term_points" name="mid_term_points[]" />
    </td>
    <td style="width: 20%;">
        <select name="final_term_result[]" aria-label="{{ __('Select your symbol') }}" data-placeholder="{{ __('Select your symbol...') }}" class="form-select form-select-solid fw-bold final_term_results">
            <option value="">{{ __('Select your symbol...') }}</option>

        </select>
        <input type="hidden" class="final_term_points" name="final_term_points[]" />
    </td>
    <td style="width: 10%;">
        <button type="button" class="btn btn-light-danger btn-delete-subject"> <i class="fa-solid fa-trash"></i> Delete </button>
    </td>
</tr>