<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model 
{

    protected $table = 'category_translations';
    public $timestamps = true;
    protected $fillable = array('category_id', 'locale', 'name', 'title', 'alt', 'description', 'description_meta', 'keywords', 'keywords_meta');

}