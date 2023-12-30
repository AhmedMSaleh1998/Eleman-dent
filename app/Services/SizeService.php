<?php


namespace App\Services;

use App\Http\Resources\ProductSizesResource;
use App\Http\Resources\SizeResource;
use App\Repositories\SizeRepository;
use Illuminate\Http\Request;

class SizeService extends BaseService
{

    public function __construct(SizeRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }
}