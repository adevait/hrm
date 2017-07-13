<?php

namespace App\Modules\Recruitment\Models;

use Illuminate\Database\Eloquent\Model;

class JobAdvert extends Model
{
    protected $table = 'job_advert';
    protected $guarded = ['id'];
   
    public $timestamps = false;
}
