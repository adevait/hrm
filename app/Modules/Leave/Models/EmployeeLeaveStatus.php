<?php

namespace App\Modules\Leave\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeLeaveStatus extends Model
{
    protected $table = 'user_leave_status';
    protected $guarded = ['id'];
}
