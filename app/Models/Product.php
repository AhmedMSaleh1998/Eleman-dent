<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Product extends Model 
{
    use Translatable;
    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = array('price', 'image', 'quantity', 'status');

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

}