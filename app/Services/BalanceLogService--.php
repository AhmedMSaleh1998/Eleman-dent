<?php


namespace App\Services;


use App\Repository\BalanceLogRepository;
use App\Repository\DriverRepository;
use App\Repository\RestaurantRepository;
use Illuminate\Http\Request;


class BalanceLogService extends BaseService
{

    /**
     * @var DriverRepository $driverRepository
     */
    private $driverRepository;

    /**
     * @var RestaurantRepository $restaurantRepository
     */
    private $restaurantRepository;

    public function __construct(
        BalanceLogRepository $repository,
        Request $request,
        RestaurantRepository $restaurantRepository,
        DriverRepository $driverRepository
    )
    {
        parent::__construct($repository, $request);
        $this->restaurantRepository = $restaurantRepository;
        $this->driverRepository = $driverRepository;
    }

    public function store($order)
    {
        $data = [
             'order_id' => $order->id,
             'restaurant_id' => $order->restaurant_id,
             'driver_id' => $order->driver_id,
             'shipping' => $order->shipping_fees,
             'total' => ($order->total_paid - $order->shipping_fees)
        ];
        $record = $this->repository->create($data);
        return $record;
    }

    public function resetBalance($id)
    {
        $this->driverRepository->resetBalance($id);
    }

    public function resetBalanceRestaurant($id)
    {
        $this->restaurantRepository->resetBalance($id);
    }


}
