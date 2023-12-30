<?php

namespace App\Repositories;

use App\Models\ProductSize;
use Illuminate\Container\Container as App;
//use Your Model

/**
 * Class SizeRepository.
 */
class ProductSizeRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return ProductSize::class;
    }
}
