<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Modules\Pim\Models\UserJobs;
use App\Modules\Pim\Models\UserContactDetails;
use App\Modules\Settings\Models\Skill;
use App\Modules\Pim\Models\UserPreference;
use App\Modules\Pim\Models\UserSocialMedia;
use App\Modules\Pim\Models\UserExperience;
use App\Modules\Pim\Models\UserEducation;
use App\Modules\Pim\Models\UserLanguage;
use App\Modules\Pim\Models\UserDocument;

class User extends Authenticatable
{
    const USER_ROLE_ADMIN = 1;
    const USER_ROLE_EMPLOYEE = 2;
    const USER_ROLE_CANDIDATE = 3;

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'gender', 'birth_date', 'password', 'role', 'notes', 'how_did_they_hear'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setEmailAttribute($email)
    {
        if(!$email) {
            $this->attributes['email'] = null;
        } else {
            $this->attributes['email'] = $email;
        }
    }

    public function setBirthDateAttribute($birthDate)
    {
        if(!$birthDate) {
            $this->attributes['birth_date'] = null;
        } else {
            $this->attributes['birth_date'] = $birthDate;
        }
    }

    public function setNotesAttribute($notes)
    {
        if(!$notes) {
            $this->attributes['notes'] = null;
        } else {
            $this->attributes['notes'] = $notes;
        }
    }

    public function jobs()
    {
        return $this->belongsTo(UserJobs::class);
    }

    public function address()
    {
        return $this->hasOne(UserContactDetails::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'user_skills');
    }

    public function user_preferences()
    {
        return $this->hasOne(UserPreference::class);
    }

    public function social_accounts()
    {
        return $this->hasMany(UserSocialMedia::class);
    }

    public function experience()
    {
        return $this->hasMany(UserExperience::class);
    }

    public function education()
    {
        return $this->hasMany(UserEducation::class);
    }

    public function languages()
    {
        return $this->hasMany(UserLanguage::class);
    }

    public function documents()
    {
        return $this->hasMany(UserDocument::class);
    }
}
