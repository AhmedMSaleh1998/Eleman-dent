@extends('layouts.admin')

@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="main-title-00">
        @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
        @elseif(Session::has('danger'))
        <div class="alert alert-danger">{{ Session::get('danger') }}</div>
        @endif
        <a style="color: #fff;" href="{{ route('admin.home') }}">الرئيسية</a>
        <a style="color: #fff;" href="{{ route('admin.order.index') }}">/ الأوردرات / </a>
        <a style="color: #36404a;"> مشاهدة </a>

        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-20"> الأوردر رقم {{ $order->id }}</h4>

            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <td>العنوان</td>
                        <td>{{ $order->address->city->name ."-". $order->address->street ."-". $order->address->building . "-" .$order->address->floor . "-" .$order->address->apartment }}</td>
                    </tr>
                    <tr>
                    <td>المستخدم</td>
                    <td><a href="{{ route('admin.user.show',  $order->user->id) }}">{{ $order->user->first_name }}</a></td>
                    </tr>
                    <tr>
                        <td>الإجمالي</td>
                        <td>{{ $order->total }}</td>
                    </tr>
                    <tr>
                        <td>الشحن</td>
                        <td>{{ $order->shipping }}</td>
                    </tr>
                    <tr>
                        <td>الحالة</td>
                        <td>
                            @if ($order->cancelled_by_user)
                            <span class="badge badge-danger">ملغي من قبل العميل</span>
                            @else
                            {{ $order->statusLabel() }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>حالات الطلب</td>
                        <td>
                            @if ($order->cancelled_by_user)
                            <span class="text-danger">تم إلغاء هذا الطلب من قبل العميل، ولا يمكن تعديل حالته.</span>
                            @else
                            <a href="{{ route('admin.order.status', [$order->id,0]) }}" class="btn btn-warning waves-effect" title="قيد المراجعة">قيد المراجعة</a>
                            <a href="{{ route('admin.order.status', [$order->id,1]) }}" class="btn btn-success waves-effect" title="تأكيد">تأكيد</a>
                            <a href="{{ route('admin.order.status', [$order->id,2]) }}" class="btn btn-info waves-effect" title="تم التوصيل">تم التوصيل</a>
                            <a href="{{ route('admin.order.status', [$order->id,3]) }}" class="btn btn-danger waves-effect" title="إلغاء">إلغاء</a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>


        </div>

        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-20">المنتجات</h4>
            <table class="table table-bordered table-striped ">

                <thead>
                    <tr>
                        <td>اسم المنتج</td>
                        <td>الكمية</td>
                        <td>السعر</td>
                        <td>الإجمالي</td>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($order->cartItem))
                    @foreach ($order->cartItem as $item)
                    <tr>
                        <td><a href="{{ route('admin.product.show',$item->product->id) }}" target="_blank">{{ $item->product->name }}</a></td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ ($item->price) * ($item->quantity)}}</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div><!-- end col -->
</div>
@endsection