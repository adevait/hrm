<?php

namespace App\Modules\Pim\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Settings\Models\Skill;

class UserSkill extends Model
{
    protected $table = 'user_skills';
    protected $guarded = ['id'];

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
}
