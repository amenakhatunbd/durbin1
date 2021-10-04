<?php

namespace App\Model\Common;

use App\SM\SM;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public function scopeOwner($query)
    {
        if (SM::current_user_role() != 1) {
            return $query->where('created_by', SM::current_user_id());
        }
    }
    public function categories()
    {
        return $this->morphToMany("App\Model\Common\Category", "categoryable");
    }

    public function tags()
    {
        return $this->morphToMany("App\Model\Common\Tag", "taggable");
    }

    public function user()
    {
        return $this->belongsTo("App\Admin", "created_by");
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
