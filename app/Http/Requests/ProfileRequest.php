<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
            'gender' => ['in:m,f'],
            'birth_date' => ['date']
        ];

        $rules['email'] = [
            'required',
            'email',
            Rule::unique('users')->ignore($this->user()->id)
        ];

        return $rules;
    }
}
