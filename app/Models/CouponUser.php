<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponUser extends Model 
{

    protected $table = 'coupon_user';
    public $timestamps = true;
    protected $fillable = array('user_id', 'coupon_id');

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function coupon()
    {
        return $this->belongsTo('App\Models\Coupon');
    }

}