<?php

namespace App\Modules\Pim\Repositories;

use DB;
use App\Repositories\EloquentRepository;
use App\Modules\Pim\Models\UserEducation;
use App\Modules\Pim\Repositories\Interfaces\EmployeeEducationRepositoryInterface;

class EmployeeEducationRepository extends EloquentRepository implements EmployeeEducationRepositoryInterface
{
    public function __construct(UserEducation $model)
    {
        $this->model = $model;
    }
}
