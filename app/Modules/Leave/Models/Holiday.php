<?php

namespace App\Modules\Leave\Models;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $table = 'holidays';
    protected $guarded = ['id'];
}
