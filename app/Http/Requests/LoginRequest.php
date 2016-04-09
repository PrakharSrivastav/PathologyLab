<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

/**
 * This Request Class validates the Login form against the input
 * and redirects to the login page if the validations fails
 * 
 * @author Prakhar
 * @created 07-04-2016
 */
class LoginRequest extends Request
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
     * username required | alpha numeric | minimum 3 characters
     * password required
     * 
     * @return array
     */
    public function rules()
    {
        return [
            "username" => "required|alpha_num|min:3",
            "password" => "required"
        ];
    }
}
