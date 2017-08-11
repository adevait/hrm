<?php

namespace App\Modules\Pim\Repositories;

use DB;
use App\Repositories\EloquentRepository;
use App\Modules\Pim\Models\UserSkill;
use App\Modules\Pim\Repositories\Interfaces\EmployeeSkillRepositoryInterface;

class EmployeeSkillRepository extends EloquentRepository implements EmployeeSkillRepositoryInterface
{
    public function __construct(UserSkill $model)
    {
        $this->model = $model;
    }

    public function getEmployeSkills($employeeId)
    {
        $skills = $this->getByMany(['user_id' => $employeeId])->get();
        $response = [];
        foreach ($skills as $key => $value) {
            $response[$value->skill->name]=$value->skill->name;
        }
        return $response;
    }
}
