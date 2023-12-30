<?php


namespace App\Services;


use App\Repository\AdminRepository;
use App\Repository\PermissionRepository;
use Illuminate\Http\Request;

class AdminService extends BaseService
{
    /**
     * @var PermissionRepository $permissionRepository
     */
    private $permissionRepository;

    public function __construct(AdminRepository $repository, Request $request, PermissionRepository $permissionRepository)
    {
        parent::__construct($repository, $request);
        $this->permissionRepository = $permissionRepository;
    }


    public function getFormData()
    {
        return ['roles' => $this->permissionRepository->pluck('name', 'id')];
    }

    public function store($data)
    {
        $toStore = $data->except(['password', 'roles']);
        $toStore['password'] = bcrypt($data['password']);
        $admin = parent::store($toStore);
        $admin->roles()->attach($data->get('roles'));
        return $admin;
    }

    public function update($id, $request)
    {

        $record = parent::update($id, $request->only(
            'name', 'email', 'status'
        ));


        if ($request->has('password') && !empty($request->get('password'))) {
            $record->password = bcrypt($request->password);
            $record->save();
        }

        $record->roles()->sync($request->get('roles'));

        return $record;
    }
}
