<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Payment extends Model 
{
    use Translatable;
    protected $table = 'payments';
    public $timestamps = true;

}