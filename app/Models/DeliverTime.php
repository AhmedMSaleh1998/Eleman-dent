<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliverTime extends Model 
{

    protected $table = 'delivery_times';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('from', 'to', 'status');

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

}