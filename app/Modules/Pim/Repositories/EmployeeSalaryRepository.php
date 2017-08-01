<?php

namespace App\Modules\Pim\Repositories;

use DB;
use App\Repositories\EloquentRepository;
use App\Modules\Pim\Models\Salary;
use Carbon\Carbon;
use App\Modules\Pim\Repositories\Interfaces\EmployeeSalaryRepositoryInterface;

class EmployeeSalaryRepository extends EloquentRepository implements EmployeeSalaryRepositoryInterface
{
    public function __construct(Salary $model)
    {
        $this->model = $model;
    }
}
