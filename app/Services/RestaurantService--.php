<?php


namespace App\Services;

use App\Criteria\ConditionsCriteria;
use App\Criteria\WithCriteria;
use App\Helpers\MessageSender;
use App\Helpers\Point;
use App\Http\Resources\MenuResource;
use App\Http\Resources\RestaurantResource;
use App\Prototype\FilterMeta;

use App\Repository\CategoryRepository;
use App\Repository\DistrictRepository;
use App\Repository\MenuRepository;
use App\Repository\RestaurantMenuRepository;
use App\Repository\RestaurantRepository;
use App\Utils\FilterUtil;
use App\Utils\OperatorUtil;
use Illuminate\Http\Request;

class RestaurantService extends BaseService
{

    /**
     * @var RestaurantMenuRepository $restaurantMenuRepository
     */
    private $restaurantMenuRepository;

    /**
     * @var MenuRepository $menuRepository
     */
    private $menuRepository;

    /**
     * @var CategoryRepository $categoryRepository
     */
    private $categoryRepository;

    /**
     * @var DistrictRepository $distirctRepository
     */
    private $distirctRepository;

    /**
     * @var AuthService $authService
     */
    private $authService;

    /**
     * @var BalanceLogService $balanceLogService
     */
    private $balanceLogService;


    /**
     * RestaurantService constructor.
     * @param RestaurantRepository $repository
     * @param Request $request
     * @param RestaurantMenuRepository $restaurantMenuRepository
     * @param CategoryRepository $categoryRepository
     * @param MenuRepository $menuRepository
     * @param DistrictRepository $distirctRepository
     * @param AuthService $authService
     * @param BalanceLogService $balanceLogService
     */
    public function __construct(
        RestaurantRepository $repository,
        Request $request,
        RestaurantMenuRepository $restaurantMenuRepository,
        CategoryRepository $categoryRepository,
        MenuRepository $menuRepository,
        DistrictRepository $distirctRepository,
        AuthService $authService,
        BalanceLogService $balanceLogService
    )
    {
        parent::__construct($repository, $request);

        $this->filters = [
            'name' => new FilterMeta('name', FilterUtil::STRING_FILTER),
            'id' => new FilterMeta('id', FilterUtil::NUMBER_FILTER),
        ];

        $this->with = [
           'restaurant_menus',
            'restaurant_menus.menu',
            'image_file'
        ];

        $this->restaurantMenuRepository = $restaurantMenuRepository;
        $this->menuRepository = $menuRepository;
        $this->categoryRepository = $categoryRepository;
        $this->distirctRepository = $distirctRepository;
        $this->authService = $authService;
        $this->balanceLogService = $balanceLogService;
    }

    public function viewWithMenu($restaurant_id, $menu_id)
    {
      $data = $this->restaurantMenuRepository->pushCriteria(new ConditionsCriteria([
          [
              'field' => 'restaurant_id',
              'operator' => OperatorUtil::EQUAL_OPERATOR,
              'value' => $restaurant_id
          ],
          [
              'field' => 'menu_id',
              'operator' => OperatorUtil::EQUAL_OPERATOR,
              'value' => $menu_id
          ],
      ]))->pushCriteria(new WithCriteria(['menu.features','active_products', 'active_products.options', 'active_products.additions']))->first();
      return new MenuResource($data);
    }

    public function viewWithMenuOffer($restaurant_id)
    {
        $ids = $this->restaurantMenuRepository->pushCriteria(new ConditionsCriteria([
        [
            'field' => 'restaurant_id',
            'operator' => OperatorUtil::EQUAL_OPERATOR,
            'value' => $restaurant_id
        ]
        ]))->whereHas('products', function ($sql) {
            return $sql->where('offer', 1);
        })->pluck('menu_id');
        $data = [];
        foreach ($ids as $id) {
            $data[] = $this->viewWithMenu($restaurant_id, $id);
        }
        return $data;
    }

    public function updateOpenStatus($status)
    {
        $restaurant = $this->repository->find(getCurrentRestaurant());
        $restaurant->updateOpenStatus($status);
    }

    public function getFormData()
    {
        $categories  = $this->categoryRepository->pluck('name', 'id');
        $menus  = $this->menuRepository->pluck('name', 'id');
        $districts  = $this->distirctRepository->pluck('name', 'id');
        return ['categories' => $categories,  'menus' => $menus, 'districts' => $districts];
    }

    public function show($id, $with = [])
    {
        return new RestaurantResource(parent::show($id));
    }

    public function getBalances($id)
    {
        $this->balanceLogService->filters = ['restaurant_id' => new FilterMeta('restaurant_id', FilterUtil::EQUAL_FILTER, $id)];
        return $this->balanceLogService->paginate();
    }

    public function resetBalanceItem($id)
    {
        $this->balanceLogService->update($id, ['is_paid_by_restaurant' => 1]);
    }

    public function store($request)
    {
        $record = parent::store($request->validated());
        if ($request->has('password') && !empty($request->get('password'))) {
            $record->password = bcrypt($request->password);
            $record->save();
            //$this->sendPasswordToClient($record, $request->password);
        }
        $record->categories()->attach($request->get('categories'));
        $record->menus()->attach($request->get('menus'));
        return $record;
    }


    public function updatePassword($request)
    {
        $user = $this->authService->changePassword('restaurant', $request->password);
        $data =  $this->authService->login(
            'restaurant',
            ['phone' => $user->phone,  'password' => $request->password],
            ['status' => 1]
        );
        return $data;
    }

    public function update($id, $request)
    {
        $record = parent::update($id, $request->only(
            'name', 'address', 'email', 'phone', 'district_id', 'logo', 'image',
            'description', 'lat','long','status', 'is_open' , 'order_no'
        ));

        if ($request->has('password') && !empty($request->get('password'))) {
            $record->password = bcrypt($request->password);
            $record->save();
            //$this->sendPasswordToClient($record, $request->password);
        }

        $record->categories()->sync($request->get('categories'));

        $record->menus()->sync($request->get('menus'));

        return $record;
    }

    public function sendPasswordToClient($restaurant, $password)
    {
        $sender = new MessageSender();
        $sender->send($restaurant->phone, "Your Password now is '".$password."' and you can change it from your profile");
    }

    public function calculateFees($restaurant_id, $request)
    {
        $restaurant = $this->repository->find($restaurant_id);
        return calculateShippingFees(new Point($request->lat, $request->long),  new Point($restaurant->lat, $restaurant->long));
    }

}
