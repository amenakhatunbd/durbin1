<?php

namespace App\Model\Common;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        "id",
        "fullname",
        "email",
        "subject",
        "phone",
        "message",
        "status"
    ];
    protected $table = 'contacts';
}
