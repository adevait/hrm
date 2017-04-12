<?php

namespace App\Modules\Pim\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Settings\Models\Company;

class UserExperience extends Model
{
    protected $table = 'user_experience';
    protected $guarded = ['id'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function setEndDate($endDate)
    {
        if(!$endDate) {
            $this->attributes['endDate'] = null;
        } else {
            $this->attributes['endDate'] = $endDate;
        }
    }
}
