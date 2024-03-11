<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
    
    public function total()
    {
        $total = CartItem::where('user_id', get_current_user())
        ->whereNull('order_id')
        ->sum(DB::raw('price * quantity'));

        return $total;
    }
}