<?php

namespace App\Modules\Settings\Repositories;

use App\Repositories\EloquentRepository;
use App\CustomField;
use App\Modules\Settings\Repositories\Interfaces\CustomFieldsRepositoryInterface;

class CustomFieldsRepository extends EloquentRepository implements CustomFieldsRepositoryInterface
{
    protected $allowedAttributes = ['model'];

    public function __construct(CustomField $model)
    {
        $this->model = $model;
    }

    public function getByType($type)
    {
        return $this->getByMany(['type' => $type])
            ->orderBy('category')
            ->get();
    }

    public function getByDetails($key, $type)
    {
        return $this->getByMany(['key' => $key, 'type' => $type])
            ->first();
    }
}
