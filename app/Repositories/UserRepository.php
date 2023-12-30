<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Container\Container as App;
//use Your Model

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return User::class;
    }
}
