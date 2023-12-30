<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelatedProducts extends Model 
{

    protected $table = 'related_products';
    public $timestamps = true;
    protected $fillable = array('product_id', 'related_id');

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function related()
    {
        return $this->belongsTo('App\Models\Product');
    }

}