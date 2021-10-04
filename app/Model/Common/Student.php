<?php

namespace App;
namespace App\Model\Common;
use App\SM\SM;


use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
	public $timestamps = true;
    protected $fillable = [
        'title',
        'email',
        'description'
    ];
}
