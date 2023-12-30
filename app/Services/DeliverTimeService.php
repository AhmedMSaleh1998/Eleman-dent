<?php


namespace App\Services;


use App\Repositories\DeliverTimeRepository;
use Illuminate\Http\Request;

class DeliverTimeService extends BaseService
{

    public function __construct(DeliverTimeRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }
}
