<?php

namespace App\Modules\Pim\Repositories;

use App\Repositories\EloquentRepository;
use App\Modules\Pim\Models\UserContactDetails;
use App\Modules\Pim\Repositories\Interfaces\EmployeeContactDetailsRepositoryInterface;

class EmployeeContactDetailsRepository extends EloquentRepository implements EmployeeContactDetailsRepositoryInterface
{
    public function __construct(UserContactDetails $model)
    {
        $this->model = $model;
    }
}
