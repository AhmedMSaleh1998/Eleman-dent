<?php

namespace App\Services;


use App\Repository\OrderRepository;
use App\Utils\OrderStatusUtil;
use Illuminate\Http\Request;

class DashboardService extends BaseService
{



    public function __construct(
        OrderRepository $repository,
        Request $request
    )
    {
        parent::__construct($repository, $request);
    }


    public function getDriverData()
    {
        return $this->getDriverDashboardData(auth('driver')->user());
    }

    public function getDriverDashboardData($driver)
    {
        return [
            'pending' => $this->repository->getPendingDriverCount(auth('driver')->user()),
            'accepted' => $this->repository->getAcceptedDriverCount(auth('driver')->user()),
            'delivered' => $driver->orders()->where('status', OrderStatusUtil::COMPLETED)->count(),
            'on_delivery' => $driver->orders()->where('driver_id',$driver->id)->where('status', OrderStatusUtil::ON_DELIVERY)->count(),
            'revenue' =>  number_format(
                $driver->orders()->accepted()->where('status', OrderStatusUtil::COMPLETED)->sum('shipping_fees') * (getSettingValue('shipping_percentage')/100) ,
                2
            ),
            'current_revenue' => number_format($driver->balance_logs()->where('is_paid_by_driver', 0)->sum('shipping') * (getSettingValue('shipping_percentage')/100), 2),
        ];
    }


    public function getRestaurantData()
    {
        return $this->getRestaurantDashboardData(auth('restaurant')->user());
    }

    public function getRestaurantDashboardData($restaurant)
    {

        return [
            'pending' => $restaurant->orders()->accepted()->where('status', OrderStatusUtil::PENDING)->count(),
            'accepted' => $restaurant->orders()->accepted()->where('status', OrderStatusUtil::ACCEPTED)->count(),
            'delivered' => $restaurant->orders()->accepted()->where('status', OrderStatusUtil::COMPLETED)->count(),
            'canceled' => $restaurant->orders()->accepted()->where('status', OrderStatusUtil::CANCELED)->count(),
            'rejected' => $restaurant->orders()->accepted()->where('status', OrderStatusUtil::REJECTED)->count(),
            'working_on' => $restaurant->orders()->accepted()->where('status', OrderStatusUtil::WORK_ON)->count(),
            'on_delivery' => $restaurant->orders()->accepted()->where('status', OrderStatusUtil::ON_DELIVERY)->count(),
            'revenue' => number_format(
                ($restaurant->orders()->accepted()->where('status', OrderStatusUtil::COMPLETED)->sum('total_paid') -
                    $restaurant->orders()->accepted()->where('status', OrderStatusUtil::COMPLETED)->sum('shipping_fees')),
                2
            ),
            'current_revenue' => number_format($restaurant->balance_logs()->where('is_paid_by_restaurant', 0)->sum('total'), 2),
        ];
    }

    public function save($request)
    {
        $this->repository->create($request->validated());
    }
}
