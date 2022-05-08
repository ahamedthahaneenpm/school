<?php

namespace App\Http\Requests\Admin\Teacher;

use Illuminate\Foundation\Http\FormRequest;

class TeacherSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('teacher_create') ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
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