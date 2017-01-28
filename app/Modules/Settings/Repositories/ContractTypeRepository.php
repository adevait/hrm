<?php

namespace App\Modules\Settings\Repositories;

use App\Repositories\EloquentRepository;
use App\Modules\Settings\Models\ContractType;
use App\Modules\Settings\Repositories\Interfaces\ContractTypeRepositoryInterface;

class ContractTypeRepository extends EloquentRepository implements ContractTypeRepositoryInterface
{
    public function __construct(ContractType $model)
    {
        $this->model = $model;
    }
}
