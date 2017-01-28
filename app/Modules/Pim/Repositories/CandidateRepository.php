<?php

namespace App\Modules\Pim\Repositories;

use DB;
use App\Repositories\EloquentRepository;
use App\User;
use Carbon\Carbon;
use App\Modules\Pim\Repositories\Interfaces\CandidateRepositoryInterface;

class CandidateRepository extends EloquentRepository implements CandidateRepositoryInterface
{
    protected $allowedAttributes = ['model'];
    
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getQry($filter = array(), $columns = [])
    {
        $response = $this->model->whereNull('deleted_at');

        foreach ($filter as $key => $value) {
            $response->where($value['key'], $value['operator'], $value['value']);
        }

        if ($columns) {
            return $response->select($columns);
        }

        $response = $response->get();

        return $response;
    }
}
