<?php

namespace App\Modules\Pim\Repositories;

use App\Repositories\EloquentRepository;
use App\Modules\Pim\Models\UserPreference;
use App\Modules\Pim\Repositories\Interfaces\EmployeePreferencesRepositoryInterface;

class EmployeePreferencesRepository extends EloquentRepository implements EmployeePreferencesRepositoryInterface
{
    public function __construct(UserPreference $model)
    {
        $this->model = $model;
    }
}
