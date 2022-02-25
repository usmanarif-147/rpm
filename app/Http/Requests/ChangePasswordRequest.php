<?php

namespace App\Http\Requests;

use App\Rules\MatchOldPassword;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => ['required', 'min:5' , new MatchOldPassword()],
            'new_password' => 'required|min:5',
            'new_confirm_password' => 'same:new_password',
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => 'Old password is required',
            'new_password.required' => 'Password field is required',
            'new_confirm_password.same' => 'New Password and confirm password must match',
        ];
    }
}
