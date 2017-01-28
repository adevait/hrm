<?php

namespace App\Modules\Pim\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Settings\Repositories\Interfaces\SalaryComponentsRepositoryInterface as SalaryComponentsRepository;

class EmployeeSalaryRequest extends FormRequest
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
    public function rules(SalaryComponentsRepository $salaryComponentRepository)
    {
        // $fields = $salaryComponentRepository->getAll();
        $rules = [
            'components' => ['required'],
            'payment_date' => ['required']
        ];

        return $rules;
    }
}
