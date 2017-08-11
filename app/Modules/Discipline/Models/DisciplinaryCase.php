<?php

namespace App\Modules\Discipline\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class DisciplinaryCase extends Model
{
    protected $table = 'disciplinary_cases';
    protected $guarded = ['id'];

    public function employee()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
