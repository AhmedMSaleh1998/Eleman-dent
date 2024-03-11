<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventImage extends Model 
{

    protected $table = 'event_images';
    public $timestamps = true;
    protected $fillable = array('event_id', 'image', 'alt');

}