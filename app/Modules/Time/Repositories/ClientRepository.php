<?php

namespace App\Modules\Time\Repositories;

use App\Repositories\EloquentRepository;
use App\Modules\Time\Models\Client;
use App\Modules\Time\Repositories\Interfaces\ClientRepositoryInterface;

class ClientRepository extends EloquentRepository implements ClientRepositoryInterface
{
    public function __construct(Client $model)
    {
        $this->model = $model;
    }
}
