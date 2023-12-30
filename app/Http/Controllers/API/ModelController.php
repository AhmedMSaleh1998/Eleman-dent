<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Services\ModelService;
use Auth;
use Exception;

class ModelController extends BaseController
{
    public function __construct(ModelService $service)
    {
        parent::__construct($service);
    }

    public function __invoke()
    {
        try {
            $data = $this->service->get();
            return $this->sendResponse($data, 'تم عرض الموديلات بنجاح');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }
}