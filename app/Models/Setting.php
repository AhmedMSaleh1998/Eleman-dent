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
    protected $fillable = array('location_one','location_two','src_one','src_two','email', 'phone_one' , 'phone_two', 'whatsapp', 'facebook', 'instagram', 'youtube', 'twitter', 'free_shipping');
    public $translatedAttributes = ['address_one','address_two','about_us', 'keywords', 'privacy', 'terms'];

}