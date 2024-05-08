<tr>
    <td>
        <select name="module_id[]" aria-label="{{ __('Module') }}" data-placeholder="{{ __('Select module...') }}" data-control="select2" class="form-select form-select-solid fw-bold">
            <option value="" style="display: none;" disabled selected>Select Module</option>
            @foreach ($modules as $module)
            <option value="{{ $module->id }}">
                {{ $module->module_name }} ({{ $module->module_code }})
            </option>
            @endforeach
        </select>
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
</tr>