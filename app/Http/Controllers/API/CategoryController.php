<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
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

    public function get($parent_id = null)
    {
        try {
            $data = $this->service->getApi($parent_id);
            return $this->sendResponse($data, 'تم عرض الاقسام بنجاح');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }
}
