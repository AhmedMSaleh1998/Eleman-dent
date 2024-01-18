<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model 
{

    protected $table = 'admins';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'password');

}