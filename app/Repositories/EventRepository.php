<?php

namespace App\Repositories;

use App\Models\Event;
use Illuminate\Container\Container as App;
//use Your Model

/**
 * Class ProductRepository.
 */
class EventRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Event::class;
    }
}
