<?php

namespace App\Http\Requests\Admin\Score;

use Illuminate\Foundation\Http\FormRequest;

class ScoreUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('score_update') ? true : false;
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