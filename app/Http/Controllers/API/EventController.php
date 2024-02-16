<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Services\EventService;
use Exception;
class EventController extends BaseController
{
    public function __construct(EventService $service)
    {
        parent::__construct($service);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = $this->service->index();
            return $this->sendResponse($data, 'Events fetched successfully',200);
        } catch (Exception $exception) {
            return $this->sendError('error', $exception->getMessage());
        }
    }
}
