<?php

namespace App;
namespace App\Model\Common;
use App\SM\SM;
use Illuminate\Database\Eloquent\Model;

class Gest extends Model
{
    protected $table = 'gests';
	public $timestamps = true;
    protected $fillable = [
        'title',
        'email',
        'phone',
        'description'
    ];
}