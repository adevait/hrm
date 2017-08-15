<?php

namespace App\Modules\Pim\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Settings\Repositories\Interfaces\SalaryComponentsRepositoryInterface as SalaryComponentsRepository;

class EmployeeSalaryRequest extends FormRequest
{
    private $salaryComponentRepository;

    public function __construct(SalaryComponentsRepository $salaryComponentRepository)
    {
        parent::__construct();
        $this->salaryComponentRepository = $salaryComponentRepository;
    }

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
            'payment_date' => ['required'],
            'attachment' => ['mimes:png,jpg,pdf,xls,xlsx,csv,txt']
        ];

        $fields = $this->salaryComponentRepository->getAll();
        foreach ($fields as $key => $value) {
            $rules['components.'.$value->id] = 'required';
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        $fields = $this->salaryComponentRepository->getAll();

        foreach ($fields as $key => $value) {
            $messages['components.'.$value->id.'.required'] = $value->name.' is required.';
        }
        
        return $messages;
    }
}
