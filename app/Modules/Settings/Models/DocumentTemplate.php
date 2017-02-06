<?php

namespace App\Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentTemplate extends Model
{
    const TYPE_PIM = 1;
    const TYPE_LEAVE = 2;
    const TYPE_RECRUITMENT = 3;
    const TYPE_DISCIPLINE = 4;

    protected $table = 'document_templates';
    protected $guarded = ['id'];
}
