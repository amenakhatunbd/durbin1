<?php

namespace App;

namespace App\Model\Common;
use App\SM\SM;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = 'posts';
	public $timestamps = true;
    protected $fillable = [
        'title',
        'description'
    ];
}
