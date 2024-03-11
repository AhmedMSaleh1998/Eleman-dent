<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Resources\CityResource;
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

    public function get()
    {
        
        try {
            $data = $this->service->getAll();
            return $this->sendResponse(CityResource::collection($data), 'تم عرض المدن بنجاح' , 200);
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage(),400);
        }
    }
}
