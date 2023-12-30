<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{

    protected $table = 'product_sizes';
    public $timestamps = true;
    protected $fillable = array('name_ar', 'name_en', 'product_id', 'price', 'discount_price', 'status');

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
