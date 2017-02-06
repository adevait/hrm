<?php

namespace App\Modules\Pim\Models;

use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{
    protected $table = 'user_documents';
    protected $guarded = ['id'];
}
