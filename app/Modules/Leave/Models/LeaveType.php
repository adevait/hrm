<?php

namespace App\Modules\Leave\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    protected $table = 'leave_types';
    protected $guarded = ['id'];
}
