<?php

namespace App\Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{
    protected $table = 'custom_fields';
    protected $guarded = ['id'];
}
