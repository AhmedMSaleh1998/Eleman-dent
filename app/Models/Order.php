<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('shipping', 'total', 'payment_id', 'address_id', 'status');

    public function cartItem()
    {
        return $this->hasMany('App\Models\CartItem');
    }

}