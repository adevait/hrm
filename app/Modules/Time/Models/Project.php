<?php

namespace App\Modules\Time\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Project extends Model
{
    protected $table = 'projects';
    protected $guarded = ['id'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function assignees()
    {
        return $this->belongsToMany(User::class, 'projects_users');
    }
}
