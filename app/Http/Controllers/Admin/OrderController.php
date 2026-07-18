<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Services\OrderService;

class OrderController extends BaseController
{
    public function __construct(OrderService $service)
    {
        parent::__construct($service);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->service->getAll();
        return view('admin.order.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = $this->service->show($id);
        /* foreach ($order->cartItems as $item) {
            dd($item->ProductSize->product->id);
        } */

        return view('admin.order.show', compact('order'));
    }

    public function updateStatus($order_id, $status)
    {
        try {
            $this->service->updateStatus($order_id, $status);
            return redirect()->back()->with(['success' => 'تم تحديث حالة الطلب بنجاح']);
        } catch (\Exception $exception) {
            return redirect()->back()->with(['danger' => $exception->getMessage()]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->service->destroy($id);
        return redirect(route('admin.order.index'))->with(['success' => 'تم حذف الأوردر بنجاح']);
    }
}
