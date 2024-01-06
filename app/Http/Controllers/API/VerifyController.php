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
            $data = $this->service->activate($request->email, $request->code);
            return $this->sendResponse($data, 'Email Verified Successfully',200);
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage(),400);
        }
    }
}
