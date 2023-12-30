<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Services\ColorService;
use Auth;
use Exception;

class ColorController extends BaseController
{
    public function __construct(ColorService $service)
    {
        parent::__construct($service);
    }

    public function __invoke()
    {
        try {
            $data = $this->service->get();
            return $this->sendResponse($data, 'تم عرض الالوان بنجاح');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }
}
