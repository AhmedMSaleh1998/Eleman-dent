   <?php


namespace App\Services;


use App\Helpers\DiscountCalculator;
use App\Repository\BasketRepository;
use App\Utils\AddonTypeUtil;
use Illuminate\Http\Request;

class BasketService extends BaseService
{
    /**
     * @var MealService $mealService
     */
    private $mealService;

    /**
     * RestaurantService constructor.
     * @param BasketRepository $repository
     * @param Request $request
     */
    public function __construct(
        BasketRepository $repository,
        Request $request,
        MealService $mealService
    ) {
        parent::__construct($repository, $request);
        $this->mealService = $mealService;
    }

    public function store($data)
    {
        $addons  = [];
        $product = $this->mealService->show($data->get('product_id'));

        foreach ($data->get('options') as $option) {
            $price = $product->options->filter(function ($item) use ($option) {
                return $item->id == $option;
            })->first()->pivot->price;
            $addons[] = [
                'addon_id' => $option,
                'addon_type' => AddonTypeUtil::OPTION,
                'price' => $price,
                'discount' => DiscountCalculator::priceAfterDiscount($product, $price)
            ];
        }

        foreach ($data->get('additions') ?? [] as $addition) {
            $addons[] = [
                'addon_id' => $addition,
                'addon_type' => AddonTypeUtil::ADDITION,
                'price' => $product->additions->filter(function ($item) use ($addition) {
                    return $item->id == $addition;
                })->first()->pivot->price
            ];
        }
        $basket = parent::store(
            $data->only(['user_id', 'note', 'quantity', 'product_id', 'restaurant_id']) +
                ['user_id' => getCurrentUser(),  'restaurant_id' => request('restaurant_id')]
        );
        $basket->details()->createMany($addons);
        $basket->total_price = $basket->details->sum('price') *  $basket->quantity;
        $basket->discount = $basket->details->sum('discount') *  $basket->quantity;
        $basket->save();
        return $basket;
    }
}
