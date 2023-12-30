<?php


namespace App\Services;


use App\Repositories\MaterialRepository;
use Illuminate\Http\Request;

class MaterialService extends BaseService
{

    public function __construct(MaterialRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }
}