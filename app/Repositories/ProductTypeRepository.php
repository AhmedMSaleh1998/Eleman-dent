<?php

namespace App\Repositories;

use App\Models\CouponUser;
use App\Models\ProductType;
use Illuminate\Container\Container as App;
//use Your Model

/**
 * Class CouponUserRepository.
 */
class CouponUserRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return ProductType::class;
    }
}
