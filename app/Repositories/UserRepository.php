<?php

namespace App\Repositories;

use DB;
use App\Repositories\EloquentRepository;
use App\User;

class UserRepository extends EloquentRepository
{
    protected $allowedAttributes = ['model'];

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function pluckName()
    {
        return $this->model->select(DB::raw('CONCAT(first_name, " ", last_name) as name, id'))
            ->pluck('name', 'id');
    }
}
