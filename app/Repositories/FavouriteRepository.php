<?php

namespace App\Repositories;

use App\Models\FavouriteProduct;
use Illuminate\Container\Container as App;
//use Your Model

/**
 * Class ProductRepository.
 */
class FavouriteRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return FavouriteProduct::class;
    }
}
