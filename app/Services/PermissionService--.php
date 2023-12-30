<?php


namespace App\Services;



use App\Helpers\HandelEditHasManyRelation;
use App\Repository\IRepository;
use App\Repository\CityRepository;
use App\Repository\PermissionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class PermissionService extends BaseService
{

    public function __construct(PermissionRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);

    }

    public function get()
    {
        return $this->repository->get();
    }

    public function getFormData()
    {
        $data = [];
        $data['permissions'] = $this->repository->getPermissions();
        return $data;
    }

    public function store($data)
    {
        $record = parent::store($data->only('name'));
        $record->permissions()->sync($data->get('permissions'));
        Artisan::call('optimize:clear');
        return $record;
    }

    public function update($id, $data)
    {
        $record = parent::update($id, $data->only('name'));
        $record->permissions()->sync($data->get('permissions'));
        Artisan::call('optimize:clear');
        return $record;
    }

    public function destroy($id)
    {
        $role = $this->getRecordData($id);
        if ($role->name == 'super-admin') {
            return false;
        }
        parent::destroy($id);
        return true;
    }


}
