<?php

namespace App\Repositories;

use App\Models\City;
use Illuminate\Container\Container as App;
//use Your Model

/**
 * Class DistrictRepository.
 */
class CityRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return City::class;
    }
}
