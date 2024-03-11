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

    public function show($id)
    {
        try {
            // $with = ['products'];
            $data = $this->service->show($id);
            // $data = Category::with('products')->where('id' , $id)->get();

            // dd($data);
            // $data = Category::first();
            return $this->sendResponse(new CategoryResource($data), 'تم عرض القسم بنجاح' , 200);
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }
}
