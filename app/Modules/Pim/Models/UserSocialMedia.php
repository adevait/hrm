<?php

namespace App\Modules\Pim\Models;

use Illuminate\Database\Eloquent\Model;

class UserSocialMedia extends Model
{
    const FACEBOOK = 1;
    const TWITTER = 2;
    const LINKEDIN = 3;
    const GITHUB = 4;
    const BEHANCE = 5;
    const MEDIUM = 6;
    const DRIBBLE = 7;
    protected $table = 'user_social_media';
    protected $guarded = ['id'];
}
