<?php

namespace App\Modules\Pim\Repositories;

use DB;
use App\Repositories\EloquentRepository;
use App\Modules\Pim\Models\Salary;
use App\Modules\Pim\Models\Currency;
use App\Modules\Pim\Models\CurrentSalary;
use Carbon\Carbon;
use App\Modules\Pim\Repositories\Interfaces\EmployeeSalaryRepositoryInterface;

class EmployeeSalaryRepository extends EloquentRepository implements EmployeeSalaryRepositoryInterface
{
    const SALARY_TYPE_FULL = 0;
    const SALARY_TYPE_HOUR = 1;

    public function __construct(Salary $model)
    {
        $this->model = $model;
    }

    /**
     * Returns the current salary for the given user
     * 
     * @param  integer $userId
     * 
     * @return Salary
     */
    public function getCurrentSalary($userId)
    {
        return CurrentSalary::where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->first();
    }

    /**
     * Changes the current salary value
     * 
     * @param  array $salary
     * 
     * @return Salary
     */
    public function changeCurrentSalary(array $salary)
    {
        $currentSalary = CurrentSalary::insert($salary);
        return $currentSalary;
    }

    /**
     * Returns all currencies
     * 
     * @return array
     */
    public function getCurrencies()
    {
        return Currency::pluck('currency_display', 'id');
    }

    /**
     * Returns salary types
     * @return array
     */
    public function getSalaryTypes()
    {
        return [
            self::SALARY_TYPE_FULL => trans('app.pim.employees.salaries.config.type_full'),
            self::SALARY_TYPE_HOUR => trans('app.pim.employees.salaries.config.type_hour'),
        ];
    }
}
