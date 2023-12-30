<?php

namespace App\Repositories;

use App\Models\ProductRate;
use Illuminate\Container\Container as App;
//use Your Model

/**
 * Class ProductRateRepository.
 */
class ProductRateRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return ProductColor::class;
    }
}
