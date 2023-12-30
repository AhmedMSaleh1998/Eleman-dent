<?php

namespace App\Repositories;

use App\Models\Type;
use Illuminate\Container\Container as App;
//use Your Model

/**
 * Class SoleRepository.
 */
class TypeRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Type::class;
    }
}
