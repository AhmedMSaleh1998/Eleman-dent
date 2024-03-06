<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Category extends Model 
{
    use Translatable;

    public $translatedAttributes = ['name', 'alt', 'keywords', 'keywords_meta', 'title', 'description', 'description_meta'];
    protected $table = 'categories';
    public $timestamps = true;
    protected $fillable = array('image', 'status');

    public function category_products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

}