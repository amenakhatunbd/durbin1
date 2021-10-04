<?php

namespace App\Model\Common;

use App\SM\SM;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function scopeOwner($query)
    {
        if (SM::current_user_role() != 1) {
            return $query->where('created_by', SM::current_user_id());
        }
    }

    public function payment()
    {
        return $this->belongsTo('App\Model\Common\Payment');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function orderaddress()
    {
        return $this->hasOne(Orderaddress::class);
    }

    public function detail()
    {
        return $this->hasMany('App\Model\Common\Order_detail');
    }

    public function payment_method()
    {
        return $this->belongsTo(Payment_method::class);
    }
}
