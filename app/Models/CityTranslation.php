<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class CityTranslation extends Model 
{
   
    protected $table = 'cities_translations';
    public $timestamps = true;
    protected $fillable = array('city_id', 'name', 'locale');
}