<?php

namespace App\Repositories;

use App\Models\Certificate;
use Illuminate\Container\Container as App;
//use Your Model

class CertificateRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Certificate::class;
    }
}
