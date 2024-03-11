<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\AboutUsResource;
use App\Services\AboutService;
use Illuminate\Http\Request;
use App\Http\Resources\CustomerReviewResource;
use App\Http\Resources\ListAchievmentResource;
use App\Http\Resources\ListBannerResource;
use App\Http\Resources\ListBrandResource;
use App\Http\Resources\ListCategoryResource;
use App\Http\Resources\ListEventResource;
use App\Http\Resources\ListProductResource;
use App\Models\Achievement;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CustomerReview;
use App\Models\Event;
use App\Models\Product;
use App\Models\Setting;
// use App\Repository\CategoryRepository;
use App\Repositories\CityRepository;

class AboutController extends BaseController
{
    public function __construct(AboutService $service)
    {
        parent::__construct($service);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = [];
            $data['banners'] = ListBannerResource::collection(Banner::all());
            $data['about'] = new AboutUsResource(Setting::first());
            $data['achievements'] = ListAchievmentResource::collection(Achievement::take('6')->get());
            $data['brands'] = ListBrandResource::collection(Brand::all());
            return $this->sendResponse($data, 'تم عرض من نحن بنجاح',200);
        } catch (\Exception $exception) {
            return $this->sendError('خطأ.', $exception->getMessage());
        }
    }
}