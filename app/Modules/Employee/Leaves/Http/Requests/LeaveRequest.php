<?php

namespace App\Modules\Employee\Leaves\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Leave\Repositories\Interfaces\EmployeeLeaveRepositoryInterface as EmployeeLeaveRepository;
use Route;
use Auth;

class LeaveRequest extends FormRequest
{
    private $employeeLeaveRepository;

    public function __construct(EmployeeLeaveRepository $employeeLeaveRepository)
    {
        parent::__construct();
        $this->employeeLeaveRepository = $employeeLeaveRepository;
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
        return [
            'leave_type_id' => ['required'],
            'start_date' => ['required', 'after:now'],
            'end_date' => ['required', 'after:start_date']
        ];
    }

    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        if($validator->errors()->any()) {
            return $validator;
        }
        
        $validator->after(function($validator) {

            $available = $this->employeeLeaveRepository->checkAvailableDays(
                Auth::user()->id,
                $this->get('leave_type_id'),
                $this->get('start_date'),
                $this->get('end_date'),
                Route::input('employee_eeaf')
            );

            if(!$available['status']) {
                $validator->errors()->add('end_date', trans('app.leave.employee_leaves.error_no_available_days', ['days' => $available['availableDays']]));
            }
        });

        return $validator;
    }
}
