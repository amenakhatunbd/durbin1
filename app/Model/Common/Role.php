<?php

namespace App\Model\Common;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['name', 'permission', 'created_by', 'modified_by', 'status '];
}
