<?php

namespace App\Model\Common;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public function scopeOwner($query)
    {
        if (SM::current_user_role() != 1) {
            return $query->where('created_by', SM::current_user_id());
        }
    }

    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }
}
