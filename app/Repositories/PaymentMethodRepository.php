<?php

namespace App\Repositories;

use App\Models\PaymentMethod;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Container\Container as App;
//use Your Model

/**
 * Class PaymentRepository.
 */
class PaymentMethodRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Payment::class;
    }
}
