<?php

namespace App\Modules\Settings\Repositories;

use App\Repositories\EloquentRepository;
use App\Modules\Settings\Models\EducationInstitution;
use App\Modules\Settings\Repositories\Interfaces\EducationInstitutionRepositoryInterface;

class EducationInstitutionRepository extends EloquentRepository implements EducationInstitutionRepositoryInterface
{
    public function __construct(EducationInstitution $model)
    {
        $this->model = $model;
    }
}
