<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = array('name_ar', 'name_en', 'category_id', 'description_ar', 'description_en', 'image', 'sku', 'status', 'popular');

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function images()
    {
        return $this->hasMany('App\Models\ProductImage');
    }

    public function sizes()
    {
        return $this->hasMany('App\Models\Productsize');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }

    public function types()
    {
        return $this->belongsToMany(type::class);
    }

    public function related()
    {
        return $this->belongsToMany(Product::class, 'related_products', 'product_id', 'related_id');
    }
}
