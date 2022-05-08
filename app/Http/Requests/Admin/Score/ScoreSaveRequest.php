<?php

namespace App\Http\Requests\Admin\Score;

use Illuminate\Foundation\Http\FormRequest;

class ScoreSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('score_create') ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'student_id' => 'required',
            'maths' => 'required',
            'sceince' => 'required',
            'history' => 'required',
            'term' => 'required',
        ];
    }

    public function messages()
    {
        return [];
    }

    public function attributes()
    {
        return [];
    }
}