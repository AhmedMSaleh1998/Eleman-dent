<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventTranslation extends Model 
{

    protected $table = 'event_translations';
    public $timestamps = true;
    protected $fillable = array('event_id', 'locale', 'name', 'location', 'description');

}