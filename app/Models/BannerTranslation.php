<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerTranslation extends Model 
{

    protected $table = 'banner_translations';
    public $timestamps = true;
    protected $fillable = array('banner_id', 'locale', 'alt');

}