<?php

namespace App\Repositories;

use App\Models\About;
use Illuminate\Container\Container as App;
//use Your Model

/**
 * Class AboutRepository.
 */
class AboutRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return About::class;
    }
}
