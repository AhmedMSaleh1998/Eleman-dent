<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Resources\CertificateResource;
use App\Services\CertificateService;
use Exception;
class CertificateController extends BaseController
{
    public function __construct(CertificateService $service)
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
            $data = $this->service->getAll();
            return $this->sendResponse(CertificateResource::collection($data), 'Certificate fetched successfully',200);
        } catch (Exception $exception) {
            return $this->sendError('error', $exception->getMessage());
        }
    }

}
