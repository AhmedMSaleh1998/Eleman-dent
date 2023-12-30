<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Container\Container as App;
//use Your Model

/**
 * Class OrderRepository.
 */
class OrderRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Order::class;
    }
}
