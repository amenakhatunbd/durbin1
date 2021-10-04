<?php

namespace App\Model\Common;

use Illuminate\Database\Eloquent\Model;

class Productattribute extends Model
{
    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }

    public function attributetitle()
    {
        return $this->belongsTo(Attributetitle::class);
    }
}
