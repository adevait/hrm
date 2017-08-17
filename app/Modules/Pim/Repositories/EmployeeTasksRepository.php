<?php

namespace App\Modules\Pim\Repositories;

use App\Repositories\EloquentRepository;
use App\Modules\Pim\Models\UserTask;
use App\Modules\Pim\Repositories\Interfaces\EmployeeTasksRepositoryInterface;

class EmployeeTasksRepository extends EloquentRepository implements EmployeeTasksRepositoryInterface
{
    public function __construct(UserTask $model)
    {
        $this->model = $model;
    }
}
