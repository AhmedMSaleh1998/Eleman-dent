<?php

namespace App\Repositories;

use App\Models\CustomerReview;
use Illuminate\Container\Container as App;
//use Your Model

/**
 * Class AboutRepository.
 */
class CustomerReviewRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return CustomerReview::class;
    }
}
