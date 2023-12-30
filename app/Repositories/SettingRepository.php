<?php

namespace App\Repositories;

use App\Models\Setting;
use Illuminate\Container\Container as App;
//use Your Model

/**
 * Class SettingRepository.
 */
class SettingRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Setting::class;
    }
}
