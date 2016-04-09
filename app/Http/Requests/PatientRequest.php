<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PatientRequest extends Request
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
            "patientname" => "required|min:3",
            "email" => "required|email",
            "passcode"=> "required",
            "dob" => "required|date_format:d-m-Y",
            "sex"=>"required|in:0,1,2"
        ];
    }
}
