<?php

namespace App\Repositories;

use App\Models\Address;
use Illuminate\Container\Container as App;
//use Your Model

/**
 * Class AddressRepository.
 */
class AddressRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Address::class;
    }
}
