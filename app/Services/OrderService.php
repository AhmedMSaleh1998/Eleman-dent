<?php

namespace App\Services;

use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderDetailsResource;
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
use App\Mail\OrderStatusChanged;
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

            $this->basketRepository->multipleUpdate($baskets->pluck('id'), ['order_id' => $order->id]);

            DB::commit(); // Commit the transaction

            // إشعارات الطلب بالإيميل خدمة مستقلة — بعد تأكيد الطلب، ولو الميل مش شغّال الطلب بيفضل متسجّل
            safeSendMail(function () use ($user, $order) {
                Mail::to('info@elemandental.com')->send(new OrderCreatedAdmin($user));
                Mail::to($order->user->email)->send(new OrderCreatedUser($user));
            }, 'order created notification');

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
        $order = Order::with(['cartItem.product', 'payment', 'address.city', 'user'])
            ->where('id', $id)
            ->where('user_id', getCurrentUser())
            ->firstOrFail();

        return new OrderDetailsResource($order);
    }

    public function cancelOrder($id)
    {
        DB::beginTransaction();

        try {
            $order = Order::with('cartItem')
                ->where('id', $id)
                ->where('user_id', getCurrentUser())
                ->firstOrFail();

            if ($order->status == 2) {
                throw new Exception('لا يمكن إلغاء طلب تم توصيله');
            }

            if ($order->status == 3) {
                throw new Exception('تم إلغاء هذا الطلب بالفعل');
            }

            // إرجاع الكمية للمخزون (عكس ما تم خصمه عند إنشاء الطلب)
            foreach ($order->cartItem as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->quantity += 1;
                    $product->save();
                }
            }

            $order->status = 3;
            $order->cancelled_by_user = true;
            $order->update();

            DB::commit();

            // إشعار العميل بإلغاء الطلب بالإيميل — خدمة مستقلة
            $order->load(['user', 'address.city']);
            if ($order->user && $order->user->email) {
                safeSendMail(function () use ($order) {
                    Mail::to($order->user->email)->send(new OrderStatusChanged($order, 3));
                }, 'order cancelled by user');
            }

            return new OrderDetailsResource($order->load('cartItem.product', 'payment', 'address.city'));
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function updateStatus($id, $status)
    {
        // لا يُسمح للأدمن بتعديل حالة طلب ألغاه العميل بنفسه
        $existing = Order::find($id);
        if ($existing && $existing->cancelled_by_user) {
            throw new Exception('لا يمكن تعديل حالة طلب تم إلغاؤه من قبل العميل');
        }

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

        // إشعار العميل بتغيير حالة الطلب بالإيميل — خدمة مستقلة (لو الميل مش شغّال ما توقفش تحديث الحالة)
        $order->load(['user', 'address.city']);
        if ($order->user && $order->user->email) {
            safeSendMail(function () use ($order, $status) {
                Mail::to($order->user->email)->send(new OrderStatusChanged($order, $status));
            }, 'order status changed to ' . $status);
        }
    }
}
