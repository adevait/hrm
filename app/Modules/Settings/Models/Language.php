<?php

namespace App\Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';
    protected $guarded = ['id'];
}
