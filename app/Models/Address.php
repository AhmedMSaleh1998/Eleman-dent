<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{

    protected $table = 'addresses';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('district_id', 'street', 'building', 'floor', 'apartment', 'phone', 'longitude', 'Latitude', 'status', 'user_id');

    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }
}
