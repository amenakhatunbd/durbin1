<?php

namespace App;

namespace App\Model\Common;
use App\SM\SM;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shops';
	public $timestamps = true;
    protected $fillable = [
        'title',
        'description'
    ];
}
