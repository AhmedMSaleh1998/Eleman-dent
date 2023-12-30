<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Services\SizeService;
use Auth;
use Exception;

class SizeController extends BaseController
{
    public function __construct(SizeService $service)
    {
        parent::__construct($service);
    }

    public function __invoke()
    {
        try {
            $data = $this->service->get();
            return $this->sendResponse($data, 'تم عرض المقاسات بنجاح');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }
}