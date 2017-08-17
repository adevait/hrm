<?php

namespace App\Modules\Pim\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserTask extends Model
{
    protected $table = 'user_tasks';
    protected $guarded = ['id'];

    public function candidate()
    {
        return $this->belongsTo(User::class, 'candidate_id');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
    
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
}
