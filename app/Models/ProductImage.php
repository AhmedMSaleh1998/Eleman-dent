<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model 
{

    protected $table = 'product_images';
    public $timestamps = true;
    protected $fillable = array('image', 'product_id');

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

}