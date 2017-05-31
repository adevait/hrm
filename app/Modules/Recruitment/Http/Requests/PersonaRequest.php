<?php

namespace App\Modules\Recruitment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Settings\Repositories\Interfaces\CustomFieldsRepositoryInterface as CustomFieldsRepository;

class PersonaRequest extends FormRequest
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
    public function rules(CustomFieldsRepository $customFieldsRepository)
    {
        $rules = [
            'name' => ['required']
        ];
        $fields = $customFieldsRepository->getByType($customFieldsRepository->model::TYPE_PERSONA);
        foreach ($fields as $key => $value) {
            $rules['fields.'.$value->id] = 'required';
        }
        return $rules;
    }
}
