<?php


namespace App\Services;

use App\Http\Resources\CityResource;
use App\Http\Resources\DistrictResource;
use App\Models\City;
use App\Repositories\CityRepository;
use Illuminate\Http\Request;

class CityService extends BaseService
{

  private $districtRepository;

  public function __construct(CityRepository $repository, Request $request)
  {
    parent::__construct($repository, $request);
    
  }
  
  public function store($request)
    {
        $input = $request->all();
        // dd( $request->all() );
        City::create([
            'shipping_fess' => $input['shipping_fess'] ?? null,
            'en' => [
                'name' => $input['name_en'],
            ],
            'ar' => [
                'name' => $input['name_ar'],
            ],
        ]);
    }

    public function update($request, $id)
    {
        $city = $this->show($id);
        
        $city->update([
          'shipping_fess' => $request['shipping_fess'] ?? null,
            'en' => [
                'name' => $request['name_en'],
            ],
            'ar' => [
                'name' => $request['name_ar'],
            ],
        ]);
    }
}
