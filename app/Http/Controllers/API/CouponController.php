<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Services\CouponService;
use Auth;
use Exception;

class CouponController extends BaseController
{
    public function __construct(CouponService $service)
    {
        parent::__construct($service);
    }

    public function check_coupon(Request $request)
    {
        try {
            $data = $this->service->checkCoupon($request);
            return $data ? $this->sendResponse($data, 'تم تطبيق الرمز الترويجي بنجاح') : $this->sendError('الرمز الترويجى غير صحيح',$data,200);
        } catch (Exception $exception) {
;            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }
}