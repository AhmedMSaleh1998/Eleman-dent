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
        <a style="color: #fff;" href="{{route('admin.home')}}">الرئيسية</a>
        <a style="color: #fff;" href="{{route('admin.coupon.index')}}">/ الكوبونات / </a>
        <a style="color: #36404a;"> عرض </a>

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
            <h4 class="header-title m-t-0 m-b-20" style="text-align:center;">بيانات الكوبون: {{ $coupon->name }}</h4>

            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <td>الاسم</td>
                        <td>{{ $coupon->name }}</td>
                    </tr>
                    <tr>
                        <td>الكود</td>
                        <td>{{ $coupon->code }}</td>
                    </tr>
                    <tr>
                        <td>قيمة الخصم</td>
                        <td>{{ $coupon->value }}</td>
                    </tr>
                    <tr>
                        <td>نوع الخصم</td>
                        <td>{{ $coupon->type == 1 ? 'قيمة ثابتة': 'نسبة مئوية' }}</td>
                    </tr>
                    <tr>
                        <td>عدد مرات الاستخدام المتاحة</td>
                        <td>{{ $coupon->uses }}</td>
                    </tr>
                    <tr>
                        <td>متاح من تاريخ</td>
                        <td>{{ $coupon->valid_from }}</td>
                    </tr>
                    <tr>
                        <td>متاح حتى تاريخ</td>
                        <td>{{ $coupon->valid_to }}</td>
                    </tr>
                    <tr>
                        <td>الحالة</td>
                        <td>{{$coupon->status == 1 ? 'فعال' : 'غير فعال'}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div><!-- end col -->
</div>

@endsection