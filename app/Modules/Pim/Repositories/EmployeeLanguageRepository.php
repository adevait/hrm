<?php

namespace App\Modules\Pim\Repositories;

use DB;
use App\Repositories\EloquentRepository;
use App\Modules\Pim\Models\UserLanguage;
use App\Modules\Pim\Repositories\Interfaces\EmployeeLanguageRepositoryInterface;

class EmployeeLanguageRepository extends EloquentRepository implements EmployeeLanguageRepositoryInterface
{
    public function __construct(UserLanguage $model)
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
