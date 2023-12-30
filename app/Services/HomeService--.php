<?php


namespace App\Services;


use App\Http\Resources\CategoryResource;
use App\Http\Resources\User\OfferProductResource;
use App\Http\Resources\User\RestaurantResource;
use App\Repository\CategoryRepository;
use App\Repository\MealRepository;
use App\Repository\RestaurantRepository;
use Illuminate\Http\Request;

class HomeService extends BaseService
{


    /**
     * @var CategoryRepository $categoryRepository
     */
    private $categoryRepository;

    /**
     * @var RestaurantService $restaurantService
     */
    private $restaurantService;

    /**
     * @var MealRepository $mealRepository
     */
    private $mealRepository;

    public function __construct(
        RestaurantRepository $repository,
        Request $request,
        CategoryRepository $categoryRepository,
        RestaurantService $restaurantService,
        MealRepository $mealRepository
    )
    {
        parent::__construct($repository, $request);
        $this->categoryRepository = $categoryRepository;
        $this->restaurantService = $restaurantService;
        $this->mealRepository = $mealRepository;
    }


    public function getCategoriesAndProducts($category_id)
    {
        $data = [];
        $data['categories'] = CategoryResource::collection($this->categoryRepository->getActiveItems());
        $pagination  = $this->repository->getProductBasedOnCategory($category_id);
        $pagination->items(RestaurantResource::collection($pagination));
        $data['restaurants'] =  $pagination;
        $offerProducts = $this->getOfferProducts();
        $data['offers'] = OfferProductResource::collection($offerProducts);
        return $data;
    }

    public function getOfferProducts()
    {
        $items = $this->mealRepository->where('offer', 1)->paginate();
        return $items;
    }

}
