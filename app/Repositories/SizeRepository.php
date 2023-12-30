<?php

namespace App\Repositories;

use App\Models\Size;
use Illuminate\Container\Container as App;
//use Your Model

/**
 * Class SizeRepository.
 */
class SizeRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Size::class;
    }
}
