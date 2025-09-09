<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseTranslation extends Model 
{
   
    protected $table = 'course_translations';
    public $timestamps = true;
    protected $fillable = array('course_id','name', 'description', 'locale');
}