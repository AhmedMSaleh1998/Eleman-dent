<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use Translatable;
    public $translatedAttributes = ['name', 'description'];
    protected $table = 'courses';

    protected $fillable = [
        'image',
        'status',
    ];
}

