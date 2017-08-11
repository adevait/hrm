<?php

namespace App\Modules\Pim\Models;

use App\Modules\Pim\Models\SalarySalaryComponent;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $table = 'salaries';
    protected $guarded = ['id'];

    public function components()
    {
        return $this->hasMany(SalarySalaryComponent::class);
    }
}
