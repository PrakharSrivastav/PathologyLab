<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ReportRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * patient           required
     * testdate          required | date should be in the format dd-mm-yyyy
     * testedby          required | minimum 2 characters
     * reportname        required | minimum 5 characters
     * reportdetails     required | minimum 5 characters
     * additionaldetails minimum 3 characters
     * history           minimum 3 characters
     * 
     * @return array
     */
    public function rules() {
        return [
            "patient"           => "required",
            "testdate"          => "required|date_format:d-m-Y",
            "testedby"          => "required|min:2",
            "reportname"        => "required|min:5",
            "reportdetails"     => "required|min:5",
            "additionaldetails" => "min:3",
            "history"           => "min:3"
        ];
    }

}
