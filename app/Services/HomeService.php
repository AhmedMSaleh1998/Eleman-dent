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
        $data['banners'] = ListBannerResource::collection(Banner::all())->where('status' , true);
        // الأقسام المختارة يدوياً للظهور في الرئيسية (أي مستوى: رئيسي أو فرعي)
        $homeCategories = Category::with('translations')
            ->where('status', true)
            ->where('show_in_home', true)
            ->orderByRaw('home_order IS NULL, home_order ASC')
            ->orderBy('id', 'asc')
            ->get();

        // لو لم يختر الأدمن أي قسم، نعرض كل الأقسام الرئيسية حسب الترتيب
        if ($homeCategories->isEmpty()) {
            $homeCategories = Category::with('translations')
                ->where('status', true)
                ->whereNull('parent_id')
                ->orderByRaw('home_order IS NULL, home_order ASC')
                ->orderBy('id', 'asc')
                ->get();
        }

        $data['categories'] = ListCategoryResource::collection($homeCategories);
        $data['top_products'] = ListProductResource::collection(
            Product::active()
                ->where('is_top_product', 1)
                ->orderBy('seq', 'asc')
                ->take(10)
                ->get()
        );
        $data['achievements'] = ListAchievmentResource::collection(Achievement::take('6')->get());
        $data['brands'] = ListBrandResource::collection(Brand::active()->get());
        $data['events'] = ListEventResource::collection(Event::take(4)->get());
        $data['reviews'] = CustomerReviewResource::collection(CustomerReview::all());
        return $data;
    }

    public function getOfferProducts()
    {
        $items = $this->mealRepository->where('offer', 1)->paginate();
        return $items;
    }

}
