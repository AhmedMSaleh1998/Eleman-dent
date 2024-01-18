<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingTransilation extends Model 
{

    protected $table = 'setting_transaltions';
    public $timestamps = true;
    protected $fillable = array('locale', 'logo_alt', 'about_us', 'address', 'keywords', 'privacy');

}