<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Services\OrderService;
use Auth;
use Exception;

class OrderController extends BaseController
{
    public function __construct(OrderService $service)
    {
        parent::__construct($service);
    }

    public function order(Request $request)
    {
        try {
            $data = $this->service->order($request);
            return $this->sendResponse($data, 'تم الطلب بنجاح');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }

    public function my_orders()
    {

        try {
            $data = $this->service->my_orders();
            return $this->sendResponse($data, 'تم عرض الطلبات بنجاح');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }

    public function order_details($id)
    {
        try {
            $data = $this->service->orderDetails($id);
            return $this->sendResponse($data, 'تم عرض تفاصيل الطلب بنجاح');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }
}