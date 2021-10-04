<?php
namespace App;

namespace App\Model\Common;
use App\SM\SM;
use Illuminate\Database\Eloquent\Model;

class Hostel extends Model
{
    protected $table = 'hostels';

    protected $fillable = [
        'title',
        'description',
        'countrie_id'
    ];

    

    public function country(){
        return $this->belongsTo(Country::class, 'countrie_id');
        }
}






