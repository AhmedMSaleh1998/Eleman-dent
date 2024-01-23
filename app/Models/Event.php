<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Event extends Model 
{
    use Translatable;

    protected $table = 'events';
    public $timestamps = true;
    public $translatedAttributes = ['name',  'description', 'location'];
    protected $fillable = array('image', 'date','status');

}