<?php

namespace App\Modules\Recruitment\Repositories;

use DB;
use App\Repositories\EloquentRepository;
use App\Modules\Recruitment\Models\Persona;
use Carbon\Carbon;
use App\Modules\Recruitment\Repositories\Interfaces\PersonaRepositoryInterface;

class PersonaRepository extends EloquentRepository implements PersonaRepositoryInterface
{
    protected $allowedAttributes = ['model'];
    
    public function __construct(Persona $model)
    {
        $this->model = $model;
    }
}
