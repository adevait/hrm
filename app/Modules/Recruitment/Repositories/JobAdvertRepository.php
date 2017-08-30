<?php

namespace App\Modules\Recruitment\Repositories;

use App\Repositories\EloquentRepository;
use App\Modules\Recruitment\Models\JobAdvert;
use App\Modules\Recruitment\Repositories\Interfaces\JobAdvertRepositoryInterface;

class JobAdvertRepository extends EloquentRepository implements JobAdvertRepositoryInterface
{
    protected $allowedAttributes = ['model'];
    /**
     * Construction of the JobAdvert model.
     * 
     * @param JobAdvert $model
     */
    public function __construct(JobAdvert $model)
    {
        $this->model = $model;
    }
}
