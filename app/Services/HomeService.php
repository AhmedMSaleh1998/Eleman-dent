<?php


namespace App\Services;


// use App\Http\Resources\CategoryResource;

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
        $data['banners'] = Banner::all();
        $data['categories'] = Category::all();
        $data['top_products'] = Product::take(10);
        $data['achievements'] = Achievement::all();
        $data['brands'] = Brand::all();
        $data['events'] = Event::all();
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
