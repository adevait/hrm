<?php

namespace App\Modules\Time\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    protected $guarded = ['id'];
}
