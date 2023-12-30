<?php

namespace App\Services;

use App\Http\Resources\OrderResource;
use App\Models\Order;
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
        CouponRepository $couponRepository,
        Request $request,
        CartItemRepository $basketRepository,
    ) {
        parent::__construct($repository, $request);
        $this->basketRepository = $basketRepository;
        $this->couponRepository = $couponRepository;
    }

    public function order($request)
    {

        $baskets = $this->basketRepository->getCartBasketsForUser(getCurrentUser());
        if (!$baskets->count()) {
            throw new Exception();
        }

        $coupon_value = 0;

        if ($request->coupon_id) {
            $coupon = $this->couponRepository->find($request->coupon_id);

            $coupon_value = 0;

            if ($coupon) {
                $coupon_value = $coupon->type == 1 ? $coupon->value : ($request->total * ($coupon->value / 100));
            }

            if ($request['total'] < $coupon->min_total) {
                throw new Exception();
            }
        }

        $order = $this->repository->create(
            [
                'payment_id'    => $request->payment_medthod_id,
                'address_id'    => $request->address_id,
                'coupon_id'     => $request->coupon_id,
                'coupon_value'     => $coupon_value,
                'user_id'       => getCurrentUser(),
                'total'         => $request->total,
                'shipping'      => $request->shipping,
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
        return new OrderResource($order);
    }

    public function updateStatus($id, $status)
    {
        $order = $this->repository->show($id);
        $order->status = $status;
        $order->update();
    }
}
