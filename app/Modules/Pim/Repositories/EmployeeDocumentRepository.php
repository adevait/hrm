<?php

namespace App\Modules\Pim\Repositories;

use DB;
use App\Repositories\EloquentRepository;
use App\Modules\Pim\Models\UserDocument;
use Carbon\Carbon;
use App\Modules\Pim\Repositories\Interfaces\EmployeeDocumentRepositoryInterface;

class EmployeeDocumentRepository extends EloquentRepository implements EmployeeDocumentRepositoryInterface
{
    public function __construct(UserDocument $model)
    {
        $this->model = $model;
    }

    public function findBy($attribute, $value, $columns = array('*')) {
        return $this->model->where($attribute, '=', $value)->get($columns);
    }
}
