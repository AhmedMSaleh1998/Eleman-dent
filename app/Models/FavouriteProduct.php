<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavouriteProduct extends Model 
{

    protected $table = 'favourite_products';
    public $timestamps = true;
    protected $fillable = array('product_id', 'user_id');

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}