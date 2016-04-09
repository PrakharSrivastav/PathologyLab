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
