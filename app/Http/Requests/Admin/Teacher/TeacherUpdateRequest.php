<?php

namespace App\Http\Requests\Admin\Teacher;

use Illuminate\Foundation\Http\FormRequest;

class TeacherUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('teacher_update') ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required',
            'name' => 'required|max:50',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ':attribute is required',
            'name.max' => ':attribute must be maximum of 50 charcter',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Name',
        ];
    }
}