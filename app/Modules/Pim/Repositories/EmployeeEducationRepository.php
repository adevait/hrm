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
