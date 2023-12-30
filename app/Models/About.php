<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model 
{

    protected $table = 'abouts';
    public $timestamps = true;
    protected $fillable = array('description', 'policy', 'title_one', 'value_one', 'title_two', 'value_two', 'title_three', 'value_three', 'title_four', 'value_four');

}