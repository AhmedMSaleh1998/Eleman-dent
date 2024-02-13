<?php


namespace App\Services;

use App\Http\Resources\ProductModelResource;
use App\Repositories\ShoeModelRepository;
use Illuminate\Http\Request;

class ModelService extends BaseService
{

    public function __construct(ModelRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }
}