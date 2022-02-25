<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
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
            'property_id' => 'required|not_in:default',
            'make' => 'required',
            'model' => 'required',
            'license' => 'required',
            'resident_name' => 'required',
            'apartment_no' => 'required',
            'email' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'property.required' => 'Please select property',
            'property.not_in' => 'Please select valid property',
            'make.required' => 'Please enter vehicle make',
            'model.required' => 'Please enter vehicle model',
            'license.required' => 'Please enter vehicle license number',
            'resident_name.required' => 'Please enter resident name',
            'apartment_no.required' => 'Please enter apartment no',
            'email.required' => 'Please enter email address',
        ];
    }
}
