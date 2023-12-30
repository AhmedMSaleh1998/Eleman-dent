<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model 
{

    protected $table = 'districts';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name_ar', 'name_en', 'status', 'shipping_fees');

    public function addresses()
    {
        return $this->hasMany('App\Models\Address');
    }

}