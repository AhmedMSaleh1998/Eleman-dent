<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model 
{

    protected $table = 'cart_items';
    public $timestamps = true;
    protected $fillable = array('product_id', 'price', 'quantity', 'user_id');

}