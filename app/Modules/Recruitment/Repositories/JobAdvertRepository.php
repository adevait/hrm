<?php

namespace App\Modules\Recruitment\Repositories;

use DB;
use App\Repositories\EloquentRepository;
use App\User;
use App\Modules\Recruitment\Models\JobAdvert;
use Carbon\Carbon;
use App\Modules\Recruitment\Repositories\Interfaces\JobAdvertRepositoryInterface;

class JobAdvertRepository extends EloquentRepository implements JobAdvertRepositoryInterface
{
    protected $allowedAttributes = ['model'];
    
    public function __construct(JobAdvert $model)
    {
        $this->model = $model;
    }
}
