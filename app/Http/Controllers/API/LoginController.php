<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Services\AuthService;
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
            return $this->sendResponse($data, 'logged in seccessfully' ,200);
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage(),400);
        }
    }
}
