<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Validation\ValidationException;
use Auth;
use Exception;

class RegisterController extends BaseController
{
    public function __construct(AuthService $service)
    {
        parent::__construct($service);
    }

    public function register(UserRequest $request)
    {
        try {
            $data = $this->service->userRegister($request);
            return $this->sendResponse($data, 'Email Registered Sussessfully , Code Sent To Email' , 200);
        } catch (ValidationException $exception) {
            return $this->sendError('خطأ في البيانات المدخلة.', $exception->errors());
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }
}
