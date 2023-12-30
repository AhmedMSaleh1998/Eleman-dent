<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('card_description', 'shipping', 'total', 'payment_id', 'address_id', 'coupon_id', 'user_id', 'deliver_time_id', 'deliver_type', 'deliver_date', 'coupon_value', 'status');

    public function payment_method()
    {
        return $this->belongsTo('App\Models\PaymentMethod');
    }

    public function cartItems()
    {
        return $this->hasMany('App\Models\CartItem');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function coupon()
    {
        return $this->belongsTo('App\Models\Coupon');
    }

    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }

    public function deliver_time()
    {
        return $this->belongsTo('App\Models\DeliverTime');
    }

    public function productSize()
    {
        return $this->belongsTo('App\Models\ProductSize');
    }
}
