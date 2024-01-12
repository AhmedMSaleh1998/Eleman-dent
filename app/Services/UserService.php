<?php


namespace App\Services;

use App\Criteria\ConditionsCriteria;
use App\Http\Requests\EditProfileRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;


class UserService extends BaseService
{

    public function __construct(UserRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }

    public function showProfile()
    {
        return new UserResource($this->repository->find(getCurrentUser()));
    }

    public function updateProfile($id, $request)
    {
        $user = parent::update($id, $request);
        return new UserResource($user);
    }

    public function update($id, $request)
    {

        $record = parent::update($id, $request->only(
            'name',
            'email',
            'phone',
        ));


        if ($request->has('password') && !empty($request->get('password'))) {
            $record->password = bcrypt($request->password);
            $record->save();
            //$this->sendPasswordToClient($record, $request->password);
        }


        return $record;
    }

    /* public function deleteUser($id)
    {
        $user = $this->repository->find($id);
        $user->destroy();
        // $record = parent::destroy($id);
        // return true;
        
        ->only(
            'name',
            'phone',
            'image',
        ));
        
    } */
}
