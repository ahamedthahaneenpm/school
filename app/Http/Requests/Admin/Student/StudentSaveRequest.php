<?php

namespace App\Http\Requests\Admin\Student;

use Illuminate\Foundation\Http\FormRequest;

class StudentSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('student_create') ? true : false;
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
            'age' => 'required',
            'teacher_id' => 'required',
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
            'age' => 'Age',
            'teacher_id' => 'Teacher',
        ];
    }
}