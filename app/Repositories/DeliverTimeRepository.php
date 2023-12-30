<?php

namespace App\Repositories;

use App\Models\CouponUser;
use App\Models\DeliverTime;
use Illuminate\Container\Container as App;
//use Your Model

/**
 * Class CouponUserRepository.
 */
class DeliverTimeRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return DeliverTime::class;
    }
}
