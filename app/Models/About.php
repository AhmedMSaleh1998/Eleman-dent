<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{    
        protected $table = 'abouts';
        public $timestamps = true;
        protected $fillable = array('image','value');
        public $translatedAttributes = ['name'];
}
