<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model 
{

    protected $table = 'product_translations';
    public $timestamps = true;
    protected $fillable = array('product_id', 'locale', 'name', 'title', 'alt', 'description', 'description_meta', 'keywords', 'keywords_meta');

}