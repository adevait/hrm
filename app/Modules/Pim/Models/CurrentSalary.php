<?php

namespace App\Modules\Pim\Models;

use App\Modules\Pim\Models\SalarySalaryComponent;
use Illuminate\Database\Eloquent\Model;

class CurrentSalary extends Model
{
    protected $table = 'salaries_config';
    protected $guarded = ['id'];
}
