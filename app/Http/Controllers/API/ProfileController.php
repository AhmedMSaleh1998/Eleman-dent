<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\EditProfileRequest;

class ProfileController extends BaseController
{
    public function __construct(UserService $service)
    {
        parent::__construct($service);
    }

    public function show()
    {
        try {
            $data = $this->service->showProfile(getCurrentUser());
            return $this->sendResponse($data, 'تم عرض البروفايل بنجاح');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }

    public function update(EditProfileRequest $request)
    {
        try {
            $user =  $request->validated();
            if ($request->image != null) {
                $base64Image = explode(";base64,", $request->image);
                $explodeImage = explode("image/", $base64Image[0]);
                $imageType = $explodeImage[1];
                $image_base64 = base64_decode($base64Image[1]);
                $name  = time() . '.' . $imageType;
                $path = public_path('admin_assets/images/users/' . $name);
                file_put_contents($path, $image_base64);
                $user['image'] = $name;
            }

            /* if ($request->hasFile('image')) {
                
                $user['image'] = uploadImage($user['image'], 'users', 'users', getCurrentUser());
            } */

            $data = $this->service->updateProfile(getCurrentUser(), $user);
            return $this->sendResponse($data, 'تم تعديل البروفايل بنجاح');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $data = $this->service->deleteUser($id);
            return $this->sendResponse('تم حذف البروفايل بنجاح');
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }
}
