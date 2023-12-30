<?php

namespace App\Repositories;

use App\Models\SmsReminder;
use Illuminate\Container\Container as App;
//use Your Model

/**
 * Class ShoeModelRepository.
 */
class SmsReminderRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return SmsReminder::class;
    }
}
