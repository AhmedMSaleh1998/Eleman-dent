<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandTranslation extends Model 
{

    protected $table = 'brand_translations';
    public $timestamps = true;
    protected $fillable = array('brand_id', 'locale', 'name', 'title', 'alt', 'description', 'description_meta', 'keywords', 'keywords_meta');

}