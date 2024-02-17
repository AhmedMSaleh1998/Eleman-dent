<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Services\HomeService;
use Exception;

class HomeController extends BaseController
{
    public function __construct(HomeService $service)
    {
        parent::__construct($service);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = $this->service->index();
            return $this->sendResponse($data, 'تم عرض الصفحة الرئيسية بنجاح',200);
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }
}
