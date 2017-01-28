<?php

namespace App\Modules\Leave\Repositories;

use App\Repositories\EloquentRepository;
use App\Modules\Leave\Models\LeaveType;
use App\Modules\Leave\Repositories\Interfaces\LeaveTypeRepositoryInterface;

class LeaveTypeRepository extends EloquentRepository implements LeaveTypeRepositoryInterface
{
    public function __construct(LeaveType $model)
    {
        $this->model = $model;
    }
}
