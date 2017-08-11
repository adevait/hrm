<?php

namespace App\Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';
    protected $guarded = ['id'];
}
