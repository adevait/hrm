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

    public function getQry($filter = array(), $columns = [])
    {
        $response = $this->model->whereNull('deleted_at');

        foreach ($filter as $key => $value) {
            $response->where($value['key'], $value['operator'], $value['value']);
        }

        if($columns) {
            return $response->select($columns);
        }

        $response = $response->get();

        return $response;
    }
}
