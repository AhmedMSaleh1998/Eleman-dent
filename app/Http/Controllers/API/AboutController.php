<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Services\AboutService;
use Illuminate\Http\Request;

class AboutController extends BaseController
{
    public function __construct(AboutService $service)
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
            $data = $this->service->first();
            return $this->sendResponse($data, 'تم عرض من نحن بنجاح');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }
}