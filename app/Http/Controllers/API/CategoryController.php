<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use Auth;
use Exception;

class CategoryController extends BaseController
{
    public function __construct(CategoryService $service)
    {
        parent::__construct($service);
    }

    public function list()
    {
        try {
            $data = $this->service->get();
            return $this->sendResponse(CategoryResource::collection($data), 'تم عرض الاقسام بنجاح' , 200);
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }
}
