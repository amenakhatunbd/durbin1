<?php

namespace App\Model\Common;

use App\SM\SM;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        "id",
        "title",
        "description",
        "image",
        "slug",
        "views",
        "seo_title",
        "meta_key",
        "meta_description",
        "created_by",
        "modified_by",
        "status"
    ];
    protected $table = 'authors';

    public function scopeOwner($query)
    {
        if (SM::current_user_role() != 1) {
            return $query->where('created_by', SM::current_user_id());
        }
    }

    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeIsFeatured($query)
    {
        return $query->where('is_featured', 1);
    }

    public function blogs()
    {
        return $this->morphedByMany('App\Model\Common\Blog', 'categoryable');
    }

}
