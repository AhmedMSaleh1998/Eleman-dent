<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Container\Container as App;
//use Your Model

/**
 * Class ProductRepository.
 */
class ProductRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Product::class;
    }
}
