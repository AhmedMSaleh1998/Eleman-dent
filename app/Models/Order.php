<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('shipping', 'total', 'payment_id', 'address_id', 'status', 'user_id', 'cancelled_by_user');

    protected $casts = [
        'cancelled_by_user' => 'boolean',
    ];

    /**
     * تسمية حالة الطلب — نفس مخطط تطبيق العميل:
     * 0: قيد المراجعة، 1: مؤكد، 2: تم التوصيل، 3: ملغي
     */
    public function statusLabel()
    {
        if ($this->cancelled_by_user) {
            return 'ملغي من قبل العميل';
        }

        $map = [
            0 => 'قيد المراجعة',
            1 => 'مؤكد',
            2 => 'تم التوصيل',
            3 => 'ملغي',
        ];

        return $map[$this->status] ?? 'قيد المراجعة';
    }

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

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}