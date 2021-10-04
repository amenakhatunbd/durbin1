<?php

namespace App\Model\Common;

use App\SM\SM;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    public function scopeOwner($query)
    {
        if (SM::current_user_role() != 1) {
            return $query->where('created_by', SM::current_user_id());
        }
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
//        return $this->hasOne( 'App\Model\Common\Product', 'id', 'product_id');
    }

    public function user()
    {
        return $this->belongsTo("App\Admin", "created_by");
    }
}
