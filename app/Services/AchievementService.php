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
        $record = $request->validated();
        // dd($record);
        $record['image'] = uploadImage($record['image'], 'achievements');
        Achievement::create([
            'image' => $record['image'],
            'value' => $record['value'],
            'en' => [
                'name' => $record['name_en'],
            ],
            'ar' => [
                'name' => $record['name_ar'],
            ],
        ]);
    }

    public function update($request, $id)
    {
        $acheivement = $this->show($id);
        if ($request->hasFile('image')) {
            $image = uploadImage($request['image'], 'achievements', 'achievements', $id);
        }
        $acheivement->update([
            'value' => $request['value'],
            'image' => $image ?? $acheivement->image,
            'en' => [
                'name' => $request['name_en'],
            ],
            'ar' => [
                'name' => $request['name_ar'],
            ],
        ]);
    }
}
