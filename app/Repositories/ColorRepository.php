<?php

namespace App\Repositories;

use App\Models\Color;
use Illuminate\Container\Container as App;
//use Your Model

/**
 * Class ColorRepository.
 */
class ColorRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Color::class;
    }
}
