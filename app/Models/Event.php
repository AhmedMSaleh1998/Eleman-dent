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
    public $translatedAttributes = ['name',  'description'];
    protected $fillable = array('image', 'date','status','location_one' , 'location_two' , 'src_one' , 'src_two');

    public function eventImage()
    {
        return $this->hasMany('App\Models\EventImage');
    }

    public function all_images()
    {
        $images[] = $this->eventImage->pluck('image')->prepend($this->image);
        return $images;
    }

}