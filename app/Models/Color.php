<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{

    protected $table = 'colors';
    public $timestamps = true;
    protected $fillable = array('name_ar', 'name_en', 'code', 'status');

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
