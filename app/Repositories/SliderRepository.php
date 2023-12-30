<?php

namespace App\Repositories;

use App\Models\Slider;
use Illuminate\Container\Container as App;
//use Your Model

class SliderRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Slider::class;
    }
}
