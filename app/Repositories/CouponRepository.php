<?php

namespace App\Repositories;

use App\Models\Coupon;
use Illuminate\Container\Container as App;
//use Your Model

/**
 * Class CouponRepository.
 */
class CouponRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Coupon::class;
    }
}
