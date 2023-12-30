<?php


namespace App\Services;


use App\Criteria\ConditionsCriteria;
use App\Repository\MealRepository;
use App\Repository\MenuRepository;
use App\Repository\RestaurantRepository;
use App\Utils\OperatorUtil;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;


class MealService extends BaseService
{

    /**
     * @var MenuRepository $menuRepository
     */
    private $menuRepository;

    /**
     * @var RestaurantRepository $restaurantRepository
     */
    private $restaurantRepository;

    /**
     * MealService constructor.
     * @param MenuRepository $repository
     * @param Request $request
     * @param MenuRepository $menuRepository
     * @param RestaurantRepository $restaurantRepository
     */
    public function __construct(MealRepository $repository, Request $request, MenuRepository $menuRepository, RestaurantRepository $restaurantRepository)
    {
        parent::__construct($repository, $request);
        $this->with = [
            'options', 'additions', 'restaurant_menu',
        ];
        $this->menuRepository = $menuRepository;
        $this->restaurantRepository = $restaurantRepository;
    }


    public function getFormData()
    {
        return ['menus' => $this->menuRepository->getMenusForRestaurant(\request('restaurant_id'))];
    }

    public function getFeaturesForMeal($id)
    {
        return $this->show($id)->restaurant_menu->menu->features;
    }


    public function store($data)
    {
        $restaurant_menu_id = $this->restaurantRepository->getMenuRestaurantId(request('restaurant_id'), $data->get('menu_id'));
        $options = collect($data->get('features'))->map(function ($feature) {
            return $feature['options'];
        })->collapse()->map(function ($option) {
            return [
                'option_id' => $option['id'],
                'price' => $option['price']
            ];
        })->toArray();
        $additions = collect($data->get('additions'))->map(function ($addition) {
            return [
                'addition_id' => $addition['id'],
                'price' => $addition['price'],
            ];
        })->toArray();
        $data->request->add(['restaurant_menu_id' => $restaurant_menu_id, 'options' => $options, 'additions' => $additions]);

        return $this->repository->create($data);
    }


    public function update($id, $request)
    {
        $restaurant_menu_id = $this->restaurantRepository->getMenuRestaurantId(request('restaurant_id'), $request->get('menu_id'));
        $request->request->add(['restaurant_menu_id' => $restaurant_menu_id]);
        $record = parent::update($id, $request);
        $options = [];
        $optionIndex = 1;
        $additionIndex = 1;
        $additions = [];

        foreach ($request->get('features') as $feature) {
            foreach ($feature['options'] as $option) {
                if (isset($option['price'])) {
                    $options[$optionIndex++] = ['option_id' => $option['id'], 'price' => $option['price']];
                }
            }
        }

        foreach ($request->get('additions') as $addition) {
            if (isset($addition['price'])) {
                $additions[$additionIndex++] =  ['addition_id' => $addition['id'], 'price' => $addition['price']];
            }
        }

        $record->options()->sync($options);

        $record->additions()->sync($additions);

        return $record;
    }

    public function paginate($order = [])
    {
        $this->repository->pushCriteria(new ConditionsCriteria(
            [
                [
                    'field' => 'restaurant_menu_id',
                    'operator' => OperatorUtil::IN_ARRAY,
                    'value' => $this->restaurantRepository->find($this->request->restaurant_id)->restaurant_menus->pluck('id')
                ]
            ]
        ));
        return parent::paginate();
    }

    public function updateStatus($meal_id, $status)
    {
        $meal = $this->show($meal_id);
        $restaurant = $meal->restaurant_menu->restaurant;
        if ($restaurant->id != getCurrentRestaurant()) {
            throw new ModelNotFoundException();
        }
        return $this->repository->updateStatus($meal->id,  $status);
    }

}
