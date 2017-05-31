<?php

namespace App\Modules\Recruitment\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';
    protected $guarded = ['id'];

    public function fields()
    {
        return $this->hasOne(PersonaFields::class);
    }
}
