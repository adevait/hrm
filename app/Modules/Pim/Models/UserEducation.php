<?php

namespace App\Modules\Pim\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Settings\Models\EducationInstitution;

class UserEducation extends Model
{
    const BACHELOR = 1;
    const MASTER = 2;
    const ACADEMY = 3;
    const UNDERGRADUATE = 4;
    protected $table = 'user_education';
    protected $guarded = ['id'];

    public function education_institution()
    {
        return $this->belongsTo(EducationInstitution::class);
    }

    public function setGradeAttribute($grade)
    {
        if(!$grade) {
            $this->attributes['grade'] = null;
        } else {
            $this->attributes['grade'] = $grade;
        }
    }

    public function setEndDateAttribute($endDate)
    {
        if(!$endDate) {
            $this->attributes['end_date'] = null;
        } else {
            $this->attributes['end_date'] = $endDate;
        }
    }
}
