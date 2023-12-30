<?php

namespace App\Repositories;

use App\Models\ProductImage;
use Illuminate\Container\Container as App;
//use Your Model

/**
 * Class ProductImageRepository.
 */
class ProductImageRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return ProductImage::class;
    }
}
