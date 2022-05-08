<?php

namespace App\Http\Requests\Api\Vendor\Auth;

use App\Http\Requests\Api\ApiRequest;

class LoginRequest extends ApiRequest
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
            'email' => 'nullable|email',
            'password' => 'required',
            'deviceIdentity' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => ':attribute is required',
            'password.required' => ':attribute is required',
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'Email',
            'password' => 'Password',
        ];
    }
}