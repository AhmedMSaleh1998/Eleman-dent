<?php


namespace App\Http\Controllers;

use App\Services\IService;

class BaseController extends Controller
{

    /**
     * @var IService
     */
    protected $service;

    public function __construct(IService $service)
    {
        $this->service = $service;
    }
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message , $code)
    {
        $response = [
            'code' => $code,
            'message' => $message,
            'data'    => $result,
        ];


        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 400)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];


        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }
}
