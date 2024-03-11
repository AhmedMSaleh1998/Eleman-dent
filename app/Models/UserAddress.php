<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model 
{

    protected $table = 'user_addresses';
    public $timestamps = true;
    protected $fillable = array('street', 'user_id' , 'city_id');

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}