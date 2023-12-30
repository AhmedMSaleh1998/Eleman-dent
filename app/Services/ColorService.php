<?php


namespace App\Services;

use App\Http\Resources\ProductColorResource;
use App\Repositories\ColorRepository;
use Illuminate\Http\Request;

class ColorService extends BaseService
{

    public function __construct(ColorRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }
}