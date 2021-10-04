<?php

namespace App;

namespace App\Model\Common;

use App\SM\SM;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table = 'phones';

    protected $fillable = [
        'title',
        'countrie_id',
        'description'        
    ];

    public function country(){
    return $this->belongsTo(Country::class, 'countrie_id');
    }
}
