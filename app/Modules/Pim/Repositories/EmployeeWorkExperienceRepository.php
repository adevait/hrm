<?php

namespace App\Modules\Pim\Repositories;

use DB;
use App\Repositories\EloquentRepository;
use App\Modules\Pim\Models\UserExperience;
use App\Modules\Pim\Repositories\Interfaces\EmployeeWorkExperienceRepositoryInterface;

class EmployeeWorkExperienceRepository extends EloquentRepository implements EmployeeWorkExperienceRepositoryInterface
{
    public function __construct(UserExperience $model)
    {
        $this->model = $model;
    }
}
