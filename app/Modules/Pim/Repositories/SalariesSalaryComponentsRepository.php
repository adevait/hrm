<?php

namespace App\Modules\Pim\Repositories;

use DB;
use App\Repositories\EloquentRepository;
use App\Modules\Pim\Models\SalarySalaryComponent;
use Carbon\Carbon;
use App\Modules\Pim\Repositories\Interfaces\SalariesSalaryComponentsRepositoryInterface;

class SalariesSalaryComponentsRepository extends EloquentRepository implements SalariesSalaryComponentsRepositoryInterface
{
    public function __construct(SalarySalaryComponent $model)
    {
        $this->model = $model;
    }
}
