<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Resources\PaymentResource;
use App\Services\PaymentMethodService;
use Illuminate\Http\Request;
use Exception;


class PaymentMethodController extends BaseController
{
    public function __construct(PaymentMethodService $service)
    {
        parent::__construct($service);
    }

    public function index()
    { 
        try {
            $data = $this->service->getAll();
            return $this->sendResponse(PaymentResource::collection($data), 'تم عرض طرق الدفع بنجاح' , 200);
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage(),400);
        }
    }
}

