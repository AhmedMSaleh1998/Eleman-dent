<?php


namespace App\Services;

use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Exception;

class AuthService extends BaseService
{

    public function __construct(UserRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }

    /**
     * @param $request
     * @return bool
     */
    public function userLogin(Request $request)
    {
        $user = $this->repository->where('phone', $request['phone'])->first();

        if ($user) {
            $code = substr(time(), 6);
            $user->code = $code;
            $user->update();
            return new UserResource($user);
            //return $user;
        }

        throw new Exception;
    }

    public function getAuthUser($guard)
    {
        return \auth()->guard($guard)->user();
    }

    public function userRegister($request)
    {
        $data = $request->validate(
            [
                'email'=> 'required|unique:users',
                'name' => 'required|string|max:255',
                'phone'=> 'required|unique:users'
            ]
        );
        if ($data->fails()) {
            // Return the validation errors as an array
            return response()->json(['errors' => $data->errors()->all()], 400);
            // You can use a different status code if needed
        }
        $code = substr(time(), 6);
        $data['code'] = $code;
        $user = $this->repository->create($data);
        return new UserResource($user);
    }

    public function activate($phone, $code)
    {
        $user = $this->repository->where('phone', $phone)->where('code', $code)->first();

        if ($user) {
            $user['token'] =  $user->createToken('MyApp')->plainTextToken;
            return new UserResource($user);
        }
        throw new Exception;
    }
}
