<tr>
    <td>
        <select name="school_subject_id[]" aria-label="{{ __('Select your subject') }}" data-placeholder="{{ __('Select your subject...') }}" class="form-select form-select-solid fw-bold" data-label="Subject Name" required>
            <option value="">{{ __('Select your subject...') }}</option>
            @foreach($schoolSubjects as $key => $value)
            <option value="{{ $key }}" {{ $key === old('school_subject_id', $info->school_subject_id ?? '') ? 'selected' :'' }}>{{ $value }}</option>
            @endforeach
        </select>
    </td>
    <td>
        <select name="matric_type[]" aria-label="{{ __('Select your level') }}" data-placeholder="{{ __('Select your level...') }}" class="form-select form-select-solid fw-bold matric_types" data-label="Matric Type" required>
            <option value="">{{ __('Select your level...') }}</option>
            @foreach($matricTypes as $key => $value)
            <option value="{{ $key }}" {{ $key === old('matric_type', $info->matric_type ?? '') ? 'selected' :'' }}>{{ $value }}</option>
            @endforeach
        </select>
    </td>

    <td>
        <select name="final_term_result[]" aria-label="{{ __('Select your symbol') }}" data-placeholder="{{ __('Select your symbol...') }}" class="form-select form-select-solid fw-bold final_term_results" data-label="Final Term Result" required>
            <option value="">{{ __('Select your symbol...') }}</option>

        </select>
        <input type="hidden" class="final_term_points" name="final_term_points[]" />
    </td>
    <td>
        <button type="button" class="btn btn-sm btn-light-danger btn-delete-subject"> <i class="fa-solid fa-trash"></i> </button>
    </td>
</tr>