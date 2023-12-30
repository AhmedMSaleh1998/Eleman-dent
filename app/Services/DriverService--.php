<?php


namespace App\Services;

use App\Criteria\ConditionsCriteria;
use App\Events\DeliveryPickedOrder;
use App\Events\DriveryPickedOrder;
use App\Events\OrderCompleted;
use App\Exceptions\DeliveryDistrictException;
use App\Exceptions\NotFoundEntityException;
use App\Exceptions\OrederHaveDriverException;
use App\Exceptions\YouHaveOrderException;
use App\Helpers\MessageSender;
use App\Prototype\FilterMeta;
use App\Repository\DistrictRepository;
use App\Repository\DriverRepository;
use App\Repository\OrderRepository;
use App\Utils\FilterUtil;
use App\Utils\OrderStatusUtil;
use Illuminate\Http\Request;

class DriverService extends BaseService
{

    /**+
     * @var OrderRepository $orderRepository
     */
    private $orderRepository;

    /**
     * @var DistrictRepository $districtRepo
     */
    private $districtRepo;

    /**
     * @var AuthService $authService
     */
    private $authService;

    /**
     * @var BalanceLogService $balanceLogService
     */
    private $balanceLogService;

    public function __construct(
        DriverRepository $repository,
        Request $request,
        OrderRepository $orderRepository,
        DistrictRepository $districtRepository,
        AuthService $authService,
        BalanceLogService $balanceLogService
    )
    {
        parent::__construct($repository, $request);
        $this->orderRepository = $orderRepository;
        $this->districtRepo = $districtRepository;
        $this->authService = $authService;
        $this->balanceLogService = $balanceLogService;

    }

    public function pickOrder($order_id)
    {
        $order = $this->orderRepository->findOrFail($order_id);
        $driver = $this->repository->find(getCurrentDriver());

        if ($order->driver_id ) {
            throw new OrederHaveDriverException();
        }


        if ($driver->have_order) {
            throw new YouHaveOrderException();
        }

        if (!in_array($order->restaurant->district_id, $driver->districts->pluck('id')->toArray())) {
            throw new DeliveryDistrictException();
        }


        $this->repository->makeTransAction(function () use ($order, $driver) {
          $order->driver_id = $driver->id;
          $order->save();
          $driver->have_order = $order->id;
          $driver->save();
       });

       DriveryPickedOrder::dispatch($order);
    }

    public function updatePassword($request)
    {
        $user = $this->authService->changePassword('driver', $request->password);
        $data =  $this->authService->login(
            'driver',
            ['phone' => $user->phone,  'password' => $request->password],
            ['status' => 1]
        );
        return $data;
    }

    public function getBalances($id)
    {
        $this->balanceLogService->filters = ['driver_id' => new FilterMeta('driver_id', FilterUtil::EQUAL_FILTER, $id)];
        return $this->balanceLogService->paginate();
    }

    public function resetBalanceItem($id)
    {
        $this->balanceLogService->update($id, ['is_paid_by_driver' => 1]);
    }

    public function confirmDelivery($order_id)
    {
        $order = $this->orderRepository->findOrFail($order_id);
        $driver = $this->repository->find(getCurrentDriver());

        if ( $order->driver_id != $driver->id || $order->status != OrderStatusUtil::ON_DELIVERY || $order->driver_id == null) {
            throw new NotFoundEntityException("Order");
        }

        $this->repository->makeTransAction(function () use ($order, $driver) {
            $order->driver_id = $driver->id;
            $order->status = OrderStatusUtil::COMPLETED;
            $order->compelete_time = date('Y-m-d H:i:s') ;
            $order->save();
            $driver->have_order = 0;
            $driver->save();
            $this->balanceLogService->store($order);
        });
        OrderCompleted::dispatch($order);
    }

    public function getFormData()
    {
        return ['districts' => $this->districtRepo->pluck('name', 'id')];
    }

    public function store($data)
    {
        $driver = parent::store($data->validated());

        if ($data->has('password') && !empty($data->get('password'))) {
            $driver->password = bcrypt($data->password);
            $driver->save();
            //$this->sendPasswordToClient($record, $request->password);
        }

        $driver->districts()->attach($data->get('districts'));

        return $driver;
    }

    public function update($id, $request)
    {

        $record = parent::update($id, $request->only(
            'name', 'email', 'phone',   'image',  'status'
        ));


        if ($request->has('password') && !empty($request->get('password'))) {
            $record->password = bcrypt($request->password);
            $record->save();
            //$this->sendPasswordToClient($record, $request->password);
        }

        $record->districts()->sync($request->get('districts'));

        return $record;
    }

    public function sendPasswordToClient($restaurant, $password)
    {
        $sender = new MessageSender();
        $sender->send($restaurant->phone, "Your Password now is '".$password."' and you can change it from your profile");
    }
}
