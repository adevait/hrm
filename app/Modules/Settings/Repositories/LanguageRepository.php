<?php

namespace App\Modules\Settings\Repositories;

use App\Repositories\EloquentRepository;
use App\Modules\Settings\Models\Language;
use App\Modules\Settings\Repositories\Interfaces\LanguageRepositoryInterface;

class LanguageRepository extends EloquentRepository implements LanguageRepositoryInterface
{
    public function __construct(Language $model)
    {
        $this->model = $model;
    }
}
