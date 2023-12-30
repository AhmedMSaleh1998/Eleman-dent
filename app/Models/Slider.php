<?php

namespace App\Models ;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model 
{

    protected $table = 'sliders';
    public $timestamps = true;
    protected $fillable = array('name_ar', 'image', 'name_en', 'description_ar', 'description_en', 'status');

}