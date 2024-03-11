<?php

namespace App\Repositories;

use App\Models\EventImage;
use Illuminate\Container\Container as App;
//use Your Model

/**
 * Class ProductImageRepository.
 */
class EventImageRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return EventImage::class;
    }
}
