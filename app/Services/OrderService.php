<?php

namespace App\Services;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\UserAddress;
use App\Repositories\OrderRepository;
use App\Repositories\CartItemRepository;
use App\Repositories\CouponRepository;
use Illuminate\Http\Request;
use App\Mail\OrderCreatedAdmin;
use App\Mail\OrderCreatedUser;
use Illuminate\Support\Facades\Mail;
use Exception;
use Illuminate\Support\Facades\DB;


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
        DB::beginTransaction(); // Start a transaction
        
        try {
            $baskets = $this->basketRepository->getCartBasketsForUser(getCurrentUser());
            
            $user = User::find(getCurrentUser());
            
            if (!$baskets->count()) {
                throw new Exception('السلة فارغة لا يمكن تنفيذ الطلب');
            }
            
            $total = 0;
            
            foreach($baskets as $basket) {
                $total += $basket->price * $basket->quantity;
                $product = Product::find($basket->product_id);
                $product->quantity -= 1;
                $product->save();
            }

            $address = UserAddress::find($request['address_id']);
            $total +=  $address->city->shipping_fees;
  
            $order = $this->repository->create([
                'payment_id'    => $request->payment_id,
                'address_id'    => $request->address_id,
                'user_id'       => getCurrentUser(),
                'total'         => $total,
                'shipping'      => $address->city->shipping_fees,
            ]);
            
            Mail::to('info@elemandental.com')->send(new OrderCreatedAdmin($user));
            Mail::to($order->user->email)->send(new OrderCreatedUser($user));
            
            $this->basketRepository->multipleUpdate($baskets->pluck('id'), ['order_id' => $order->id]);
    
            DB::commit(); // Commit the transaction
    
            return $order;
        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction if an exception occurs
            throw $e; // Re-throw the exception
        }
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
        if($status == 2)
        {
           $order = Order::find($id);
            foreach($order->cartItem as $item)
            {
                $product = Product::find($item->product_id);
                $product->quantity += $item->quantity;
                $product->save();
            } 
        }
        
        $order = $this->repository->show($id);
        $order->status = $status;
        $order->update();
    }
}
