<?php


namespace App\Services;

use App\Http\Resources\AddressResource;
use App\Repositories\AddressRepository;
use App\Repositories\CityRepository;
use App\Repositories\DistrictRepository;
use Illuminate\Http\Request;

class AddressService extends BaseService
{

    private $cityRepository;
    private $districtRepository;

    public function __construct(AddressRepository $repository, DistrictRepository $districtRepository, Request $request)
    {
        parent::__construct($repository, $request);

        $this->with = [
            'district'
        ];
        $this->districtRepository = $districtRepository;
    }

    public function getUserAddresses($user_id)
    {
        $data = $this->repository->where('user_id', $user_id)->where('status', '!=', '2')->get();
        return $data;
    }

    public function getDistrictsForAddress()
    {
        return $this->districtRepository->where('status', '1')->get();
    }
}
