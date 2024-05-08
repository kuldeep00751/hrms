<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class SettingsInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title_id'       => 'required',
            'surname'         => 'required',
            'first_names'       => 'required',
            'maiden_name'       => 'nullable|string|max:255',
            'gender_id'      => 'required',
            'date_of_birth'      => 'required',
            'nta_candidate_number'      => 'nullable',
            'postal_address_line_1'      => 'nullable',
            'postal_address_line_2'      => 'nullable',
            'postal_address_line_3'      => 'nullable',
            'residential_address_line_1'      => 'nullable',
            'residential_address_line_2'      => 'nullable',
            'residential_address_line_3'      => 'nullable',
            'id_number'      => 'string|nullable',
            'citizenship_status' => 'required',
            'mobile_number'     => 'required',
            'last_school_attended'     => 'required',
            'highest_grade'     => 'required',
            'year_completed'     => 'required',
            'education_system_id'     => 'required',
        ];
    }
}
