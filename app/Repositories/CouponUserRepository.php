<?php

namespace App\Repositories;

use App\Models\CouponUser;
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
        return CouponUser::class;
    }
}
