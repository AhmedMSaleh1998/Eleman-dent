<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Container\Container as App;
//use Your Model

/**
 * Class CategoryRepository.
 */
class CategoryRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Category::class;
    }
}
