<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{
    const TYPE_PERSONA = 1;

    protected $table = 'custom_fields';
    protected $guarded = ['id'];
}
