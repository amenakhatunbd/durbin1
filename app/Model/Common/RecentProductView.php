<?php

namespace App\Model\Common;

use Illuminate\Database\Eloquent\Model;

class RecentProductView extends Model
{
    //
    protected $fillable = [
        'mac_address',
        'latitude',
        'longitude',
        'created_at',
        'updated_at',
    ];
}
