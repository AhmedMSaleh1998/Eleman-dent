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
            <h4 class="header-title m-t-0 m-b-20">{{$product->name_ar}}</h4>

            <table class="table table-bordered table-striped">
                <tbody>

                    <tr>
                        <td>الصورة الرئيسية</td>
                        <td><img src="{{asset('admin_assets/images/products/'.$product->image)}}" class="img-responsive" width="100px" height="100px"></td>
                    </tr>
                    <tr>
                        <td>الاسم بالعربية</td>
                        <td>{{ $product->translate('ar')->name }}</td>
                    </tr>
                    <tr>
                        <td>الاسم بالإنجليزية</td>
                        <td>{{ $product->translate('en')->name }}</td>
                    </tr>
                    <tr>
    <td>الأقسام</td>
    <td>
        @foreach ($product->categories as $category)
            {{ $category->translate('ar')->name }}
            @if (!$loop->last)
                , <!-- Add comma if it's not the last category -->
            @endif
        @endforeach
    </td>
</tr>
                    <tr>
                        <td>عنوان الصفحة SEO (عربي)</td>
                        <td>{{ $product->translate('ar')->title }}</td>
                    </tr>
                    <tr>
                        <td>عنوان الصفحة SEO (إنجليزي)</td>
                        <td>{{ $product->translate('en')->title }}</td>
                    </tr>
                    <tr>
                        <td>النص البديل للصورة (عربي)</td>
                        <td>{{ $product->translate('ar')->alt }}</td>
                    </tr>
                    <tr>
                        <td>النص البديل للصورة (إنجليزي)</td>
                        <td>{{ $product->translate('en')->alt }}</td>
                    </tr>
                    <tr>
                        <td>الوصف (عربي)</td>
                        <td>{{ $product->translate('ar')->description }}</td>
                    </tr>
                    <tr>
                        <td>الوصف (إنجليزي)</td>
                        <td>{{ $product->translate('en')->description }}</td>
                    </tr>

                    <tr>
                        <td>وصف الميتا SEO (عربي)</td>
                        <td>{{ $product->translate('ar')->description_meta }}</td>
                    </tr>
                    <tr>
                        <td>وصف الميتا SEO (إنجليزي)</td>
                        <td>{{ $product->translate('en')->description_meta }}</td>
                    </tr><tr>
                        <td>الكلمات المفتاحية (عربي)</td>
                        <td>{{ $product->translate('ar')->keywords }}</td>
                    </tr>
                    <tr>
                        <td>الكلمات المفتاحية (إنجليزي)</td>
                        <td>{{ $product->translate('en')->keywords }}</td>
                    </tr><tr>
                        <td>كلمات الميتا المفتاحية (عربي)</td>
                        <td>{{ $product->translate('ar')->keywords_meta }}</td>
                    </tr>
                    <tr>
                        <td>كلمات الميتا المفتاحية (إنجليزي)</td>
                        <td>{{ $product->translate('en')->keywords_meta }}</td>
                    </tr>
                    <tr>
                        <td>الكمية</td>
                        <td>{{ $product->quantity }}</td>
                    </tr>
                    <tr>
                        <td>منتج مميز</td>
                        <td>{{ $product->is_top_product ? 'نعم' : 'لا' }}</td>
                    </tr>
                    <tr>
                        <td>الحالة</td>
                        <td>{{$product->status == 1 ? 'ظاهر' : 'مخفي'}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div><!-- end col -->
</div>

@endsection
