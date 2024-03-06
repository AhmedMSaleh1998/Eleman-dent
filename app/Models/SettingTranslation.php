<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingTranslation extends Model 
{

    protected $table = 'setting_transaltions';
    public $timestamps = true;
    protected $fillable = array('locale', 'logo_alt', 'about_us', 'address_one', 'address_two', 'keywords', 'privacy','terms');

}