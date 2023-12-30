<?php


namespace App\Services;

use App\Repositories\TypeRepository;
use Illuminate\Http\Request;

class TypeService extends BaseService
{

    public function __construct(TypeRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }
}
