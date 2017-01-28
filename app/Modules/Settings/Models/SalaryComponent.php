<?php

namespace App\Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Settings\Models\ContractType;

class SalaryComponent extends Model
{
    const TYPE_EARNING = 1;
    const TYPE_DEDUCTION = 2;

    protected $table = 'salary_components';
    protected $guarded = ['id'];

    public function contractType()
    {
        return $this->belongsTo(ContractType::class);
    }
}
