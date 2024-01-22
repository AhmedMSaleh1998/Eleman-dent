<?php


namespace App\Services;

use App\Models\Banner;
use App\Repositories\BannerRepository;
use Illuminate\Http\Request;

class BannerService extends BaseService
{

    public function __construct(BannerRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }

    public function store($request)
    {
        $input = $request->validated();
        $input['image'] = uploadImage($input['image'], 'banners');
        Banner::create([
            'image' => $input['image'],
            'url' => $input['url'],

            'en' => [
                'alt' => $input['alt_en'],
            ],
            'ar' => [
                'alt' => $input['alt_ar'],
            ],
        ]);
    }

    public function update($request, $id)
    {
        $banner = $this->show($id);

        if ($request->hasFile('image')) {
            $image = uploadImage($request['image'], 'banners', 'banners', $id);
        }
        $banner->update([
            'image' => $image ?? $banner->image,
            'url' => $request['url'],

            'en' => [
                'alt' => $request['alt_en'],
            ],
            'ar' => [
                'alt' => $request['alt_ar'],
            ],
        ]);
    }
}
