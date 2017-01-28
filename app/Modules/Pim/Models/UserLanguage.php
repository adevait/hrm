<?php

namespace App\Modules\Pim\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Settings\Models\Language;

class UserLanguage extends Model
{
    const SKILL_SPEAK = 1;
    const SKILL_WRITE = 2;
    const SKILL_BOTH = 3;
    const LEVEL_BEGINNER = 1;
    const LEVEL_INTERMEDIATE = 2;
    const LEVEL_FLUENT = 3;
    const LEVEL_NATIVE = 4;

    protected $table = 'user_languages';
    protected $guarded = ['id'];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
