<?php

namespace App\Modules\Pim\Repositories;

use DB;
use App\Repositories\EloquentRepository;
use App\User;
use Carbon\Carbon;
use App\Modules\Pim\Repositories\Interfaces\CandidateRepositoryInterface;

class CandidateRepository extends EloquentRepository implements CandidateRepositoryInterface
{
    protected $allowedAttributes = ['model'];
    
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
