<?php

namespace App\Modules\Settings\Repositories;

use App\Repositories\EloquentRepository;
use App\Modules\Settings\Models\JobPosition;
use App\Modules\Settings\Repositories\Interfaces\JobPositionRepositoryInterface;

class JobPositionRepository extends EloquentRepository implements JobPositionRepositoryInterface
{
    public function __construct(JobPosition $model)
    {
        $this->model = $model;
    }
}
