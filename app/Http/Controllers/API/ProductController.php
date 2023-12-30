<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ProductRateRequest;
use Illuminate\Http\Request;
use App\Services\ProductService;
use Auth;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductController extends BaseController
{
    public function __construct(ProductService $service)
    {
        parent::__construct($service);
    }

    public function getAllProducts(Request $request)
    {
        try {
            $data = $this->service->getAllProducts($request);
            return $this->sendResponse($data, 'تم عرض المنتجات بنجاح');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $data = $this->service->show($id);
            return $this->sendResponse($data, 'تم عرض المنتج بنجاح');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }

    public function rate(ProductRateRequest $request)
    {
        try {
            $data = $this->service->productRate($request->all() + ['user_id' => getCurrentUser()]);
            return $this->sendResponse($data, 'تم تقييم المنتج بنجاح');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }

    public function related($id)
    {
        try {
            $data = $this->service->relatedProducts($id);
            return $this->sendResponse($data, 'تم عرض المنتجات المشابهة بنجاح');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }

    public function isFavourite($product_id)
    {
        try {
            $data = $this->service->is_favourite($product_id);
            return $this->sendResponse($data, 'تم عرض حالة المنتج في المفضلة');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }

    public function search($filter)
    {
        try {
            $data = $this->service->search($filter);
            return $this->sendResponse($data, 'تم عرض نتيجة البحث');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }    

    public function filter_lookup()
    {
        try {
            $data = $this->service->allLookups();
            return $this->sendResponse($data, 'تم عرض نتيجة البحث');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }
}
