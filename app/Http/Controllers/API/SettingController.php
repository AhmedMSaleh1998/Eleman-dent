<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Services\SettingService;
use Illuminate\Http\Request;

class SettingController extends BaseController
{

    public function __construct(SettingService $service)
    {
        parent::__construct($service);
    }


    public function index()
    {
        try {
            $data = $this->service->first();
            return $this->sendResponse($data, 'تم عرض الاعدادات بنجاح');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }
}