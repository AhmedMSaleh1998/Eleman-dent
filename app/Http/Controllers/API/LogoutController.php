<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use Exception;

class LogoutController extends BaseController
{
    public function __construct(AuthService $service)
    {
        parent::__construct($service);
    }


    public function logout()
    {
        try {
            $data =  $this->service->logout();
            return $this->sendResponse($data, 'Logged out successfully' ,200);
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage(),400);
        }
    }
}
