<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ContactUsRequest;
use App\Services\ContactUsService;
use Illuminate\Http\Request;

class ContactUsController extends BaseController
{
    public function __construct(ContactUsService $service)
    {
        parent::__construct($service);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactUsRequest $request)
    {
        try {
            $data = $this->service->store($request->validated());
            return $this->sendResponse($data, 'تم التواصل  بنجاح');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }
}
