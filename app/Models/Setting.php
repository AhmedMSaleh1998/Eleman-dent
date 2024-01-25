<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Setting extends Model 
{
    use Translatable;
    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('email', 'phone', 'whatsapp', 'facebook', 'instagram', 'youtube', 'twitter', 'free_shipping');
    public $translatedAttributes = ['address','about_us', 'keywords', 'privacy', 'terms'];

}