<?php

namespace App\Modules\Pim\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Route;

class EmployeeRequest extends FormRequest
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
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'gender' => ['required'],
            'birth_date' => ['required']
        ];
        if(preg_match('/update/', Route::currentRouteName())) {
            $rules['email'] = [
                'required',
                'email',
                Rule::unique('users')->ignore(Route::input('employee'))
            ];
        }

        return $rules;
    }
}
