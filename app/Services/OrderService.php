<?php

namespace App\Services;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\User;
use App\Models\UserAddress;
use App\Repositories\OrderRepository;
use App\Repositories\CartItemRepository;
use App\Repositories\CouponRepository;
use Illuminate\Http\Request;
use Exception;

class OrderService extends BaseService
{

    private $basketRepository;
    private $couponRepository;
    private $paymentMethodRepository;


    public function __construct(
        OrderRepository $repository,
        Request $request,
        CartItemRepository $basketRepository,
    ) {
        parent::__construct($repository, $request);
        $this->basketRepository = $basketRepository;
    }

    public function order($request)
    {

        $baskets = $this->basketRepository->getCartBasketsForUser(getCurrentUser());
        if (!$baskets->count()) {
            throw new Exception('السلة فارغة لا يمكن تنفيذ الطلب');
        }
        $total = 0;
        foreach($baskets as $basket)
        {
            $total += $basket->price * $basket->quantity;
        }
        
        $address = UserAddress::find($request['address_id']);
        $total += $total + $address->city->shipping_fess;

        $order = $this->repository->create(
            [
                'payment_id'    => $request->payment_medthod_id,
                'address_id'    => $request->address_id,
                'user_id'       => getCurrentUser(),
                'total'         => $total,
                'shipping'      => $address->city->shipping_fess,
            ]
        );
        $this->basketRepository->multipleUpdate($baskets->pluck('id'), ['order_id' => $order->id]);

        return $order;
    }

    public function my_orders()
    {
        $order = $this->repository->get($this->with)->where('user_id', getCurrentUser());
        return OrderResource::collection($order);
    }

    public function orderDetails($id)
    {
        $order = $this->repository->show($id, $this->with);
        return $order;
    }

    public function updateStatus($id, $status)
    {
        $order = $this->repository->show($id);
        $order->status = $status;
        $order->update();
    }
}
