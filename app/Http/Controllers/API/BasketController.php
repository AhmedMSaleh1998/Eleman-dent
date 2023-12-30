<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\BasketRequest;
use Illuminate\Http\Request;
use App\Services\BasketService;
use Auth;
use Exception;

class BasketController extends BaseController
{
    public function __construct(BasketService $service)
    {
        parent::__construct($service);
    }

    public function store(Request $request)
    {
        try {
            $data = $this->service->store($request->all() + ['user_id' => getCurrentUser()]);
            return $this->sendResponse($data, 'تم !ضافة للسلة بنجاح');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }

    public function getall()
    {
        try {
            $data = $this->service->getApi();
            return $this->sendResponse($data, 'تم عرض منتجات السلة بنجاح');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->destroy($id);
            return $this->sendResponse([], 'تم حذف منتج من السلة بنجاح');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }

    public function destroyAll()
    {
        try {
            $this->service->destroyAll();
            return $this->sendResponse([], 'تم حذف السلة بنجاح');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }

    public function updateQty($id, $quantity)
    {
        try {
            $data = $this->service->updateQty($id, $quantity);
            return $this->sendResponse([], 'تم تعديل منتج من السلة بنجاح');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }
}