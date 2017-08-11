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
}
