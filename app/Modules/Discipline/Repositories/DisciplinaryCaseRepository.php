<?php

namespace App\Modules\Discipline\Repositories;

use App\Repositories\EloquentRepository;
use App\Modules\Discipline\Models\DisciplinaryCase;
use App\Modules\Discipline\Repositories\Interfaces\DisciplinaryCaseRepositoryInterface;

class DisciplinaryCaseRepository extends EloquentRepository implements DisciplinaryCaseRepositoryInterface
{
    public function __construct(DisciplinaryCase $model)
    {
        $this->model = $model;
    }
}
