<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model 
{

    protected $table = 'product_images';
    public $timestamps = true;
    protected $fillable = array('product_id', 'image', 'alt');

}