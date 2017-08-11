<?php

namespace App\Modules\Leave\Repositories;

use App\Repositories\EloquentRepository;
use App\Modules\Leave\Models\EmployeeLeaveStatus;
use App\Modules\Leave\Repositories\Interfaces\EmployeeLeaveStatusRepositoryInterface;

class EmployeeLeaveStatusRepository extends EloquentRepository implements EmployeeLeaveStatusRepositoryInterface
{
    public function __construct(EmployeeLeaveStatus $model)
    {
        $this->model = $model;
    }
}
