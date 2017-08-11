<?php

namespace App\Modules\Settings\Repositories;

use App\Repositories\EloquentRepository;
use App\Modules\Settings\Models\DocumentTemplate;
use App\Modules\Settings\Repositories\Interfaces\DocumentTemplateRepositoryInterface;

class DocumentTemplateRepository extends EloquentRepository implements DocumentTemplateRepositoryInterface
{
    protected $allowedAttributes = ['model'];
    public function __construct(DocumentTemplate $model)
    {
        $this->model = $model;
    }
}
