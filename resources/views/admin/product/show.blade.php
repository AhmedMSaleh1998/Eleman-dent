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
        <a style="color: #fff;" href="{{route('admin.product.index')}}">/ المنتجات / </a>
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
            <h4 class="header-title m-t-0 m-b-20">{{$product->name_ar}}</h4>

            <table class="table table-bordered table-striped">
                <tbody>

                    <tr>
                        <td>الصورة الرئيسية</td>
                        <td><img src="{{asset('admin_assets/images/products/'.$product->image)}}" class="img-responsive" width="100px" height="100px"></td>
                    </tr>
                    <tr>
                        <td>الاسم عربي</td>
                        <td>{{ $product->name_ar }}</td>
                    </tr>
                    <tr>
                        <td>الاسم انجليزي</td>
                        <td>{{ $product->name_en }}</td>
                    </tr>
                    <tr>
                        <td>القسم</td>
                        <td>{{ $product->category->name_ar }}</td>
                    </tr>
                    <tr>
                        <td>الوصف عربي</td>
                        <td>{{ $product->description_ar }}</td>
                    </tr>
                    <tr>
                        <td>الوصف انجليزي </td>
                        <td>{{ $product->description_en }}</td>
                    </tr>
                    <tr>
                        <td>sku</td>
                        <td>{{ $product->sku }}</td>
                    </tr>
                    <tr>
                        <td>الحالة</td>
                        <td>{{$product->status == 1 ? 'مفعل' : 'لم يفعل'}}</td>
                    </tr>
                    <tr>
                        <td>popular</td>
                        <td>{{$product->popular == 1 ? 'مفعل' : 'لم يفعل'}}</td>
                    </tr>
                    <tr>
                        <td>اللون</td>
                        <td>
                            @foreach($product->colors as $color)
                            {{ $color->name_ar }} |
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>الانواع</td>
                        <td>
                            @foreach($product->types as $type)
                            {{ $type->name_ar }} |
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div><!-- end col -->
</div>

@endsection
