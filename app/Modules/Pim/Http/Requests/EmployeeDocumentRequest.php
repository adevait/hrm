<?php

namespace App\Modules\Pim\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Route;

class EmployeeDocumentRequest extends FormRequest
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
            'name' => ['required'],
            'attachment' => ['mimes:png,jpg,pdf,xls,xlsx,csv,txt,doc,docx,zip']
        ];

        if(!preg_match('/update/', Route::currentRouteName())) {
            $rules['attachment'][] = 'required';
        }

        return $rules;
    }
}
