<?php

namespace App\Modules\Pim\Repositories;

use DB;
use App\Repositories\EloquentRepository;
use App\Modules\Pim\Models\UserSocialMedia;
use Carbon\Carbon;
use App\Modules\Pim\Repositories\Interfaces\EmployeeSocialMediaRepositoryInterface;

class EmployeeSocialMediaRepository extends EloquentRepository implements EmployeeSocialMediaRepositoryInterface
{
    public function __construct(UserSocialMedia $model)
    {
        $this->model = $model;
    }
}
