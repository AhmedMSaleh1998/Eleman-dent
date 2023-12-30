<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsReminder extends Model 
{

    protected $table = 'sms_reminders';
    public $timestamps = true;
    protected $fillable = array('phone', 'name', 'status', 'notify_order', 'notify_payment');

}