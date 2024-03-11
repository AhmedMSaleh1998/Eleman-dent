<?php

namespace App\Repositories;

use App\Models\Banner;
use Illuminate\Container\Container as App;
//use Your Model

class BannerRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Banner::class;
    }
}
