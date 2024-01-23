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
            return $this->sendResponse($data, 'تم عرض البروفايل بنجاح' , 200);
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }

    public function update(EditProfileRequest $request)
    {
        try {
            $user =  $request->validated();

            if ($request->hasFile('image')) {
                
                $user['image'] = uploadImage($user['image'], 'users', 'users', getCurrentUser());
            }

            $data = $this->service->updateProfile(getCurrentUser(), $user);
            return $this->sendResponse($data, 'Profile Updated Successfully' , 200);
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }

    public function delete()
    {
        try {
            $data = $this->service->deleteUser();
            return $this->sendResponse($data,'Profile deleted Successfully' , 200);
        } catch (Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }
}
