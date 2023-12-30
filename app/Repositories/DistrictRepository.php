<?php

namespace App\Repositories;

use App\Models\District;
use Illuminate\Container\Container as App;
//use Your Model

/**
 * Class DistrictRepository.
 */
class DistrictRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return District::class;
    }
}
