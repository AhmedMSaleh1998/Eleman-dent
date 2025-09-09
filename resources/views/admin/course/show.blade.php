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
                        <td>القيمة</td>
                        <td>{{ $coupon->value }}</td>
                    </tr>
                    <tr>
                        <td>النوع</td>
                        <td>{{ $coupon->type == 1 ? 'قيمة ثابتة': 'نسبة مئوية' }}</td>
                    </tr>
                    <tr>
                        <td>مرات الاستخدام المتاحة</td>
                        <td>{{ $coupon->uses }}</td>
                    </tr>
                    <tr>
                        <td>متاح منذ</td>
                        <td>{{ $coupon->valid_from }}</td>
                    </tr>
                    <tr>
                        <td>متاح حتي </td>
                        <td>{{ $coupon->valid_to }}</td>
                    </tr>
                    <tr>
                        <td>الحالة</td>
                        <td>{{$coupon->status == 1 ? 'مفعل' : 'لم يفعل'}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div><!-- end col -->
</div>

@endsection