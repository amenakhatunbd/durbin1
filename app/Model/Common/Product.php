<?php

namespace App\Model\Common;

use App\SM\SM;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        "id",
        "title",
        "short_description",
        "long_description",
        "image",
        "slug",
        "sku",
        "stock_status",
        "tax_class",
        "regular_price",
        "sale_price",
        "brand_id",
        "product_qty",
        "alert_quantity",
        "product_weight",
        "product_model",
        "product_type",
        "unit_id",
        "image_gallery",
        "read_a_little",
        "views",
        "seo_title",
        "meta_key",
        "meta_description",
        "created_by",
        "modified_by",
        "status",
        "bangla_english_name"
    ];
    protected $table = "products";

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

    public function categories()
    {
        return $this->morphToMany("App\Model\Common\Category", "categoryable");
    }

    public function tags()
    {
        return $this->morphToMany("App\Model\Common\Tag", "taggable");
    }
//    public function attributes()
//    {
//        return $this->morphToMany("App\Model\Common\Attribute", "attributables");
//    }

    public function productvariations()
    {
        return $this->hasMany(Productvariation::class);
    }

    public function productattributes()
    {
        return $this->hasMany(Productattribute::class);
    }

    public function attributeProduct()
    {
        return $this->hasMany(AttributeProduct::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function user()
    {
        return $this->belongsTo("App\Admin", "created_by");
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function order_details()
    {
        return $this->hasMany(Order_detail::class);
    }

    public function getStarRating()
    {
        $count = $this->reviews()->count();
        if (empty($count)) {
            return 0;
        }
        $starCountSum = $this->reviews()->sum('rating');
        $average = $starCountSum / $count;
        return $average;
    }
}
