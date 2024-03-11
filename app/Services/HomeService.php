<?php


namespace App\Services;


// use App\Http\Resources\CategoryResource;

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
// use App\Repository\CategoryRepository;
use App\Repositories\CityRepository;
use Illuminate\Http\Request;

class HomeService extends BaseService
{
    /**
     * @var \App\Repositories\BannerRepository $repository
     */
    private $bannerRepository;

    /**
     * @var MealRepository $mealRepository
     */
    private $mealRepository;

    public function __construct(CityRepository $repository, Request $request)
  {
    parent::__construct($repository, $request);
    
  }


    public function index()
    {
        $data = [];
        $data['banners'] = ListBannerResource::collection(Banner::all());
        $data['categories'] = ListCategoryResource::collection(Category::all());
        $data['top_products'] = ListProductResource::collection(Product::all());
        $data['achievements'] = ListAchievmentResource::collection(Achievement::take('6')->get());
        $data['brands'] = ListBrandResource::collection(Brand::all());
        $data['events'] = ListEventResource::collection(Event::take(3)->get());
        $data['reviews'] = CustomerReviewResource::collection(CustomerReview::all());
        return $data;
    }

    public function getOfferProducts()
    {
        $items = $this->mealRepository->where('offer', 1)->paginate();
        return $items;
    }

}
