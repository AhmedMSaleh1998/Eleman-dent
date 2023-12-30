<?php


namespace App\Services;

use App\Repositories\SliderRepository;
use Illuminate\Http\Request;

class SliderService extends BaseService
{

    public function __construct(SliderRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }
}
