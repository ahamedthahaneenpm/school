<?php

namespace App\Http\Requests\Api\Customer\Auth;

use App\Http\Requests\Api\ApiRequest;

class RegisterRequest extends ApiRequest
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
            'first_name' => 'required|string|max:50|min:2',
            'last_name' => 'required|string|max:50|min:2',
            'email' => 'nullable|email|unique:customers',
            'password' => 'required|string|min:6',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => ':attribute is required',
            'first_name.max' => ':attribute must be maximum of 50 character',
            'first_name.min' => ':attribute must be minimum of 2 character',
            'last_name.required' => ':attribute is required',
            'last_name.max' => ':attribute must be maximum of 50 character',
            'last_name.min' => ':attribute must be minimum of 2 character',
            'email.required' => ':attribute is required',
            'password.required' => ':attribute is required',
            'password.min' => ':attribute must be mininmum of 6 characters',


        ];
    }

    public function attributes()
    {
        return [
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password',
        ];
    }
}