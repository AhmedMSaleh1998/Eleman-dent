<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('shipping', 'total', 'payment_id', 'address_id', 'status','user_id');

    public function cartItem()
    {
        return $this->hasMany('App\Models\CartItem');
    }

    public function payment()
    {
        return $this->belongsTo('App\Models\Payment');
    }

    public function address()
    {
        return $this->belongsTo('App\Models\UserAddress');
    }

}