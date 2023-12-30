<?php


namespace App\Services;


use App\Repositories\AboutRepository;
use Illuminate\Http\Request;

class AboutService extends BaseService
{

    public function __construct(AboutRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }
}
