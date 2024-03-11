<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentTranslation extends Model 
{

    protected $table = 'payment_translations';
    public $timestamps = true;
    protected $fillable = array('payment_id', 'locale', 'name');

}