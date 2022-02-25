<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationRrequest extends FormRequest
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
        $rules = [
            'name' => 'required',
            'number' => 'required',
            'email' => 'required',
        ];
        if($this->getMethod() == 'POST'){
            $rules += ['password' => 'required|confirmed|min:5'];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => "Name is required",
            'number.required' => "Number is required",
            'email.required' => "Email is required",
            'password.required' => "Password is required",
            'password.confirmed' => "Password does not match",
//            'properties.confirmed' => "Please select at least one property",
        ];
    }
}
