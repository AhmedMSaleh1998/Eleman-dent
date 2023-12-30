<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model 
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('phone_one', 'phone_two', 'email_one', 'email_two', 'address_ar', 'address_en', 'facebook', 'twitter', 'instagram');

}