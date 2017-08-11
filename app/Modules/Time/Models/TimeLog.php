<?php

namespace App\Modules\Time\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class TimeLog extends Model
{
    protected $table = 'time_logs';
    protected $guarded = ['id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
