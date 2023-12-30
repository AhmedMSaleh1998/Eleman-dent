<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Auth;
use Exception;

class LoginController extends BaseController
{
    public function __construct(AuthService $service)
    {
        parent::__construct($service);
    }


    public function login(Request $request)
    {
        try {
            $data =  $this->service->userLogin($request);
            return $this->sendResponse($data, 'تم ارسال كود التحقق فى رسالة');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }
}
