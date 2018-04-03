<?php

namespace App\Modules\Pim\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'currencies';
    protected $guarded = ['id'];
}
