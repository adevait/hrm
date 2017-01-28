<?php

namespace App\Modules\Pim\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Settings\Models\ContractType;

class UserPreference extends Model
{

    const LOCATION_REMOTE = 1;
    const LOCATION_INHOUSE = 2;

    protected $table = 'user_preferences';
    protected $guarded = ['id'];

    public function contractType()
    {
        return $this->belongsTo(ContractType::class);
    }
}
