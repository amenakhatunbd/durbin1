<?php

namespace App;
namespace App\Model\Common;
use App\SM\SM;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';
	public $timestamps = true;
    protected $fillable = [
        'title',
        'description'
    ];
}
