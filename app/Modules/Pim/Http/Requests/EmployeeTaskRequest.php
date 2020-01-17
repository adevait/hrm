<?php

namespace App\Modules\Pim\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeTaskRequest extends FormRequest
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
        $rules = [
            'task_name' => ['required'],
            'assigned_to' => ['required'],
            'due_date' => ['required']
        ];

        return $rules;
    }
}
