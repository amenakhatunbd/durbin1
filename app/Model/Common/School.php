<?php

namespace App;
namespace App\Model\Common;
use App\SM\SM;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    
    protected $table = 'schools';
	public $timestamps = true;
    protected $fillable = [
        'title',
        'description'
    ];
}
