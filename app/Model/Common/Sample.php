<?php

namespace App;
namespace App\Model\Common;
use App\SM\SM;

use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    protected $table = 'samples';
	public $timestamps = true;
    protected $fillable = [
        'title',
        'gmail',
        'description'
    ];
}
