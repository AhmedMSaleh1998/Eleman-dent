<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Services\CityService;
use Auth;
use Exception;

class CityController extends BaseController
{
    public function __construct(CityService $service)
    {
        parent::__construct($service);
    }

    public function get($city_id = null)
    {
        try {
            $data = $this->service->getApi($city_id);
            return $this->sendResponse($data, 'تم عرض المدن بنجاح');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }
}
