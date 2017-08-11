<?php

namespace App\Modules\Settings\Repositories;

use App\Repositories\EloquentRepository;
use App\Modules\Settings\Models\Company;
use App\Modules\Settings\Repositories\Interfaces\CompanyRepositoryInterface;

class CompanyRepository extends EloquentRepository implements CompanyRepositoryInterface
{
    public function __construct(Company $model)
    {
        $this->model = $model;
    }
}
