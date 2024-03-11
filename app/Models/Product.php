<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Facades\DB;
class Product extends Model 
{
    use Translatable;
    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = array('price', 'image', 'quantity', 'status','category_id','brand_id');
    public $translatedAttributes = ['name','alt', 'keywords', 'keywords_meta', 'title', 'description', 'description_meta'];

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function productImage()
    {
        return $this->hasMany('App\Models\ProductImage');
    }

    public function all_images()
    {
        $images[] = $this->productImage->pluck('image')->prepend($this->image);
        return $images;
    }

    public function is_favourite()
    {
        if (getCurrentUser()) {
            return  DB::table('favourite_products')->where([
                ['product_id', '=', $this->id],
                ['user_id', '=', getCurrentUser()]
            ])->exists() ? 1 : 0;
        } else {
            return 0;
        }
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

}