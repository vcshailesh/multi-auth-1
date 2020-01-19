<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFrontUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'max:255|unique:users|nullable',
            'mobile_number' => 'required|unique:users|digits:10',
            'user_type' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'email.unique' => 'Email already register',
            'mobile_number.required' => 'Mobile number is required',
            'mobile_number.numeric' => 'Enter 10 Digit mobile number',
            'mobile_number.length' => 'Enter 10 Digit mobile number',
            'mobile_number.unique' => 'Mobile number already registered',
            'user_type.required' => 'Select user type',
            'password.required' => 'Password is required',
            'password.min' => 'Password should have atleast 6 character',
        ];
    }
}
