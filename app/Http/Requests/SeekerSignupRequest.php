<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeekerSignupRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:seekers|email',
            'dob' => 'required|date',
            'postcode' => 'required:number',
            'password' =>  [
                'required',
                'confirmed',
                'string',
                'min:4',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'current_job_title' => 'required',
            // 'g-recaptcha-response' => 'required|captcha',
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => 'Password Pattern : 1 smallcase , 1 uppercase, 1 number and 1 charcater',
        ];
    }
}
