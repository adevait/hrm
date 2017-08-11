<?php

namespace App\Modules\Settings\Repositories;

use App\Repositories\EloquentRepository;
use App\Modules\Settings\Models\SalaryComponent;
use App\Modules\Settings\Repositories\Interfaces\SalaryComponentsRepositoryInterface;

class SalaryComponentsRepository extends EloquentRepository implements SalaryComponentsRepositoryInterface
{
    protected $allowedAttributes = ['model'];
    
    public function __construct(SalaryComponent $model)
    {
        $this->model = $model;
    }
}
