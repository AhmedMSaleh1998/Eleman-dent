<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Banner extends Model 
{
    use Translatable;
    protected $table = 'banners';
    public $timestamps = true;
    protected $fillable = array('image', 'url', 'status');
    public $translatedAttributes = ['alt'];

}