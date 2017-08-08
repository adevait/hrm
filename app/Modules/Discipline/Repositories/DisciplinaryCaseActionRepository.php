<?php

namespace App\Modules\Discipline\Repositories;

use App\Repositories\EloquentRepository;
use App\Modules\Discipline\Models\DisciplinaryCaseAction;
use App\Modules\Discipline\Repositories\Interfaces\DisciplinaryCaseActionRepositoryInterface;

class DisciplinaryCaseActionRepository extends EloquentRepository implements DisciplinaryCaseActionRepositoryInterface
{
    public function __construct(DisciplinaryCaseAction $model)
    {
        $this->model = $model;
    }
}
