<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificateTranslation extends Model 
{

    protected $table = 'certificate_translations';
    public $timestamps = true;
    protected $fillable = array('certificate_id', 'locale', 'alt');

}