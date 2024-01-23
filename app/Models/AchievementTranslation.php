<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AchievementTranslation extends Model 
{

    protected $table = 'achievement_translations';
    public $timestamps = true;
    protected $fillable = array('locale', 'name', 'value', 'achievement_id');

}