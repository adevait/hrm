<?php

namespace App\Modules\Pim\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Settings\Models\JobPosition;
use App\User;
use Carbon\Carbon;

class UserJobs extends Model
{
    protected $table = 'user_jobs';
    protected $guarded = ['id'];

    public function position()
    {
        return $this->belongsTo(JobPosition::class);
    }

    public function scopeCurrent($query)
    {
        return $query->where('start_date', '<=', Carbon::now())->where('end_date', '>=', Carbon::now());
    }
}
