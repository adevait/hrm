<?php

namespace App\Modules\Time\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $guarded = ['id'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
