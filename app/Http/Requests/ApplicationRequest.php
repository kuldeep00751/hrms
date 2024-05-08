<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_info_id'       => 'required',
            'qualification_id'   => 'required',
            'study_mode_id'      => 'required',
            'campus_id'          => 'required',
            'academic_year_id'   => 'required',
            'academic_intake_id'      => 'required',
            'choice_number'      => 'required|numeric',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'academic_year_id.required' => 'An Academic Year is required',
            'academic_intake_id.required' => 'An Academic In take is required',
            'campus_id.required' => 'A campus is required',
            'study_mode_id.required' => 'Study mode is required',
            'qualification_id.required' => 'A Qualification is required',
        ];
    }
}
