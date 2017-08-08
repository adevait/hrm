<?php

namespace App\Modules\Discipline\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Modules\Discipline\Models\DisciplinaryCase;

class DisciplinaryCaseAction extends Model
{
    protected $table = 'disciplinary_cases_actions';
    protected $guarded = ['id'];

    public function disciplinaryCase() 
    {
    	return $this->belongsTo(DisciplinaryCase::class, 'disciplinary_case_id');
    }
}
