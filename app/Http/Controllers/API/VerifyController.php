<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Auth;
use Exception;

class VerifyController extends BaseController
{
    public function __construct(AuthService $service)
    {
        parent::__construct($service);
    }

    public function activate(Request $request)
    {
        try {
            $data = $this->service->activate($request->phone, $request->code);
            return $this->sendResponse($data, 'تم تأكيد الحساب بنجاح');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }
}
