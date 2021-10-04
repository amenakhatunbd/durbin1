<?php

namespace App\Model\Common;

use App\SM\SM;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
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
