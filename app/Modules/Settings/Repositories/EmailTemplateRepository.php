<?php

namespace App\Modules\Settings\Repositories;

use App\Repositories\EloquentRepository;
use App\Modules\Settings\Models\EmailTemplate;
use App\Modules\Settings\Repositories\Interfaces\EmailTemplateRepositoryInterface;

class EmailTemplateRepository extends EloquentRepository implements EmailTemplateRepositoryInterface
{
    protected $allowedAttributes = ['model'];
    public function __construct(EmailTemplate $model)
    {
        $this->model = $model;
    }
}
