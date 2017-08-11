<?php

namespace App\Modules\Dashboard\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class DashboardDocument extends Model
{
    protected $table = 'dashboard_documents';
    protected $guarded = ['id'];
}
