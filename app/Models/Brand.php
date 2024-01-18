<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Brand extends Model 
{
    use Translatable;
    protected $table = 'brand';
    public $timestamps = true;
    protected $fillable = array('status', 'image');

    public function products()
    {
        return $this->hasMany('App\Models\User');
    }

}