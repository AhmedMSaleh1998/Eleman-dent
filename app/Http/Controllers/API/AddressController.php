<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Resources\AddressResource;
use Illuminate\Http\Request;
use App\Services\AddressService;
use Auth;
use Exception;

class AddressController extends BaseController
{
    public function __construct(AddressService $service)
    {
        parent::__construct($service);
    }

    public function get()
    {
        try {
            $data = $this->service->getِApi();
            return $this->sendResponse($data, 'تم عرض العناوين بنجاح');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $this->service->store($request->all() + ['user_id' => getCurrentUser()]);
            return $this->sendResponse($data, 'تم !ضافة عنوان بنجاح');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $data = $this->service->showApi($id);
            return $this->sendResponse($data, 'تم عرض العنوان بنجاح');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }

    public function update($id, Request $request)
    {
        try {
            $data = $this->service->update($id, $request->all());
            return $this->sendResponse($data, 'تم تعديل عنوان بنجاح');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->destroy($id);
            return $this->sendResponse([], 'تم حذف عنوان بنجاح');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }
}
