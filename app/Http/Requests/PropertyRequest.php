<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
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
            'name' => 'required',
            'address' => 'required',
            'managers' => 'required|array|min:1',
            'status' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Property name is required",
            'address.required' => "Property address is required",
            'managers.required' => "Please select at least one manager",
            'status.required' => "Property status required",
        ];
    }
}
