<?php


namespace App\Services;


use App\Repositories\SettingRepository;
use Illuminate\Http\Request;

class SettingService extends BaseService
{

    public function __construct(SettingRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }
}
