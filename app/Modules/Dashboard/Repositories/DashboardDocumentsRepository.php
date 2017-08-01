<?php

namespace App\Modules\Dashboard\Repositories;

use App\Repositories\EloquentRepository;
use App\Modules\Dashboard\Models\DashboardDocument;
use App\Modules\Dashboard\Repositories\Interfaces\DashboardDocumentsRepositoryInterface;

class DashboardDocumentsRepository extends EloquentRepository implements DashboardDocumentsRepositoryInterface
{
    public function __construct(DashboardDocument $model)
    {
        $this->model = $model;
    }
}