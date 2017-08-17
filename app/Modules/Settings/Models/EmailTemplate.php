<?php

namespace App\Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $table = 'email_templates';
    protected $guarded = ['id'];
}
