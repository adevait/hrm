<?php

namespace App\Modules\Settings\Repositories;

use App\Repositories\EloquentRepository;
use App\Modules\Settings\Models\Skill;
use App\Modules\Settings\Repositories\Interfaces\SkillRepositoryInterface;

class SkillRepository extends EloquentRepository implements SkillRepositoryInterface
{
    public function __construct(Skill $model)
    {
        $this->model = $model;
    }
}
