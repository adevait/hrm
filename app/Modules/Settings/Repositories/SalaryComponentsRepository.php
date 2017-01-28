<?php

namespace App\Modules\Settings\Repositories;

use App\Repositories\EloquentRepository;
use App\Modules\Settings\Models\SalaryComponent;
use App\Modules\Settings\Repositories\Interfaces\SalaryComponentsRepositoryInterface;

class SalaryComponentsRepository extends EloquentRepository implements SalaryComponentsRepositoryInterface
{
    protected $allowedAttributes = ['model'];
    
    public function __construct(SalaryComponent $model)
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
