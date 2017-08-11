<?php

namespace App\Modules\Time\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimeLogRequest extends FormRequest
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
            'task_name' => ['required'],
            'task_description' => ['required'],
            'project_id' => ['required'],
            'user_id' => ['required'],
            'time' => ['required'],
            'date' => ['required']
        ];
    }
}
