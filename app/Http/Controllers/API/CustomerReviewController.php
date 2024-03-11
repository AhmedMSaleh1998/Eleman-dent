<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Resources\CustomerReviewResource;
use App\Services\CustomerReviewService;
use Exception;


class CustomerReviewController extends BaseController
{
    public function __construct(CustomerReviewService $service)
    {
        parent::__construct($service);
    }

    public function list()
    {
        try {
            $data = $this->service->get();
            return $this->sendResponse(CustomerReviewResource::collection($data), 'تم عرض الاراء بنجاح' , 200);
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }
}
