<?php

namespace App\Repositories;

use App\Models\Brand;
use Illuminate\Container\Container as App;
//use Your Model

/**
 * Class CategoryRepository.
 */
class BrandRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Brand::class;
    }
}
