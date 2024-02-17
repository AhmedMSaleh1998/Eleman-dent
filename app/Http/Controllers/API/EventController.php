<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Resources\EventResource;
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

    public function show($id)
    {
        try {
            $data = $this->service->show($id);
            return $this->sendResponse(new EventResource($data), 'تم عرض الحدث بنجاح' ,200);
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }

    public function getYearEvents($id)
    {
        try {
            $data = $this->service->getEventsPerYear($id);
            return $this->sendResponse( EventResource::collection($data), 'تم عرض احداث العام بنجاح' ,200);
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }
}
