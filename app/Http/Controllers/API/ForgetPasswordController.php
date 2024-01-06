<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ChangeForgetPassword;
use App\Http\Requests\ForgetPasswordRequest;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Exception;

class ForgetPasswordController extends BaseController
{

    public function __construct(AuthService $service)
    {
        parent::__construct($service);
    }
    
    /**
     * Handle the incoming request.
     */
    public function forget(ForgetPasswordRequest $request)
    {
        try {
            $data =  $this->service->forgetPassword($request);
            return $this->sendResponse($data, 'Code sent successfully' ,200);
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage(),400);
        }
    }

    public function resend(ForgetPasswordRequest $request)
    {
        try {
            $data =  $this->service->forgetPassword($request);
            return $this->sendResponse($data, 'Code sent successfully' ,200);
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage(),400);
        }
    }

    public function changePassword(ChangeForgetPassword $request)
    {
        try {
            $data =  $this->service->changePassword($request);
            return $this->sendResponse($data, 'Password Changed successfully' ,200);
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage(),400);
        }
    }
}
