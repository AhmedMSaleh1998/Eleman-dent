<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Achievement extends Model 
{
    use Translatable;

    protected $table = 'achievements';
    public $timestamps = true;
    protected $fillable = array('value');
    public $translatedAttributes = ['name'];
}