<?php
namespace App;

namespace App\Model\Common;
use App\SM\SM;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name',
        'code',
        'dial_code',
        'currency_name',
        'currency_symbol',
        'currency_code',
        'currency_rate'
    ];
    protected $table = 'countries';

    public function scopeOrderByName($query)
    {
        return $query->orderBy('currency_name');
    }

    public function scopeWhereNotNull($query)
    {
        return $query->where('currency_name', '!=', '');
    }


    public function phone(){
        return $this->belongsTo(Phone::class);
    }

    public function hostel(){
        return $this->belongsTo(Hostel::class);
    }
}
