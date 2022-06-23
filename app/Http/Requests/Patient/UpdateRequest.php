<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            "name" => "required",
            "patient_occupation" => "required",
            "father" => "required",
            "father_occupation" => "required",
            "mother" => "required",
            "mother_occupation" => "required",
            "disease_name" => "required",
            "age" => "required",
            "disease_description" => "required",
            "marital_status" => "required",
            "treatment_cost" => "required",
            "apply_amount" => "required",
            "contact" => "required",
            "present_address" => "required",
            "permanent_address" => "required"
        ];
    }

    public function message(){
        return [
            'required' => 'The :attribute field is required'
        ];
    }
}
