<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model 
{

    protected $table = 'cart_items';
    public $timestamps = true;
    protected $fillable = array('product_id', 'price', 'quantity', 'user_id');

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}