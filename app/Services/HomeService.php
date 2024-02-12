<?php


namespace App\Services;


// use App\Http\Resources\CategoryResource;

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
        $data['banners'] = ListBannerResource::collection(Banner::take(4)->get());
       
        $data['categories'] = ListCategoryResource::collection(Category::take(12)->get());
        $data['top_products'] = ListProductResource::collection(Product::take(10)->get());
        $data['achievements'] = ListAchievmentResource::collection(Achievement::all());
        $data['brands'] = ListBrandResource::collection(Brand::take(6)->get());
        $data['events'] = ListEventResource::collection(Event::take(6)->get());
        // $data['categories'] = CategoryResource::collection($this->categoryRepository->getActiveItems());
        // $pagination  = $this->repository->getProductBasedOnCategory($category_id);
        // $pagination->items(RestaurantResource::collection($pagination));
        // $data['restaurants'] =  $pagination;
        // $offerProducts = $this->getOfferProducts();
        // $data['offers'] = OfferProductResource::collection($offerProducts);
        return $data;
    }

    public function getOfferProducts()
    {
        $items = $this->mealRepository->where('offer', 1)->paginate();
        return $items;
    }

}
