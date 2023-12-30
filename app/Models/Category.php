<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model 
{

    protected $table = 'categories';
    public $timestamps = true;
    protected $fillable = array('name_ar', 'name_en', 'image', 'order', 'status');

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

}