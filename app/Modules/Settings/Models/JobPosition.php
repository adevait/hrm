<?php

namespace App\Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Settings\Models\ContractType;

class JobPosition extends Model
{
    protected $table = 'job_positions';
    protected $guarded = ['id'];

    public function contractType()
    {
        return $this->belongsTo(ContractType::class);
    }
}
