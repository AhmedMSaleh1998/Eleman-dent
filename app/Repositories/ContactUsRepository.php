<?php

namespace App\Repositories;

use App\Models\Contact;
use Illuminate\Container\Container as App;
//use Your Model

/**
 * Class ContactRepository.
 */
class ContactUsRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Contact::class;
    }
}
