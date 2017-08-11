<?php

namespace App\Modules\Leave\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class EmployeeLeave extends Model
{
    protected $table = 'user_leaves';
    protected $guarded = ['id'];

    public function employee()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function leave_type()
    {
        return $this->belongsTo(LeaveType::class);
    }
}
