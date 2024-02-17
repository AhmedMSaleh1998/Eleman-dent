<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Services\FavouriteService;
use Auth;
use Exception;

class FavouriteController extends BaseController
{
    public function __construct(FavouriteService $service)
    {
        parent::__construct($service);
    }

    public function get()
    {
        try {
            $data = $this->service->getApi();
            return $this->sendResponse($data, 'Data fetched successfully',200);
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $this->service->store($request->all() + ['user_id' => getCurrentUser()]);
            return $this->sendResponse($data, 'Applied Successfully',200);
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }

    public function destroy()
    {
        try {
            $this->service->destroyAll();
            return $this->sendResponse([], 'تم حذف المنتج من المفضلة بنجاح',200);
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }
}
