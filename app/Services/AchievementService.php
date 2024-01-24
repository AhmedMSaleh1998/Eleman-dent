<?php


namespace App\Services;

use App\Models\Achievement;
use App\Repositories\AchievementRepository;
use Illuminate\Http\Request;

class AchievementService extends BaseService
{

  private $districtRepository;

  public function __construct(AchievementRepository $repository, Request $request)
  {
    parent::__construct($repository, $request);
   
  }

  public function store($request)
  {
      $input = $request->validated();
      Achievement::create([
          'value' => $input['value'],
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
      $acheivement = $this->show($id);
      $acheivement->update([
          'value' => $request['value'],
          'en' => [
              'name' => $request['name_en'],
          ],
          'ar' => [
              'name' => $request['name_ar'],
          ],
      ]);
  }

}
