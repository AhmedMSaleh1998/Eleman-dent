@extends('layouts.admin')

@section('styles')
<!-- Plugins css-->
<link href="{{ asset('admin_assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('admin_assets/plugins/switchery/css/switchery.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admin_assets/plugins/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin_assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin_assets/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admin_assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admin_assets/plugins/bootstrap-table/css/bootstrap-table.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin_assets/plugins/custombox/css/custombox.css') }}" rel="stylesheet">
@include('admin._form_styles')
@endsection

@section('content')
<!-- Page-Title -->
@if (Session::has('success'))
<div class="alert alert-success text-center">{{ Session::get('success') }}</div>
@elseif(Session::has('danger'))
<div class="alert alert-danger text-center">{{ Session::get('danger') }}</div>
@endif
<div class="row">
    <div class="main-title-00">

        <a style="color: #fff;" href="{{ route('admin.home') }}">الرئيسية</a>
        <a style="color: #fff;" href="{{ route('admin.productimage.index',$productImage->product_id) }}">/ صور المنتج / </a>
        <a style="color: #36404a;"> تعديل </a>

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
            <h4 class="header-title m-t-0 m-b-20" style="text-align:center;">تعديل صورة المنتج</h4>

            <div class="ff-wrap">
                <p class="ff-note">الصورة اختيارية — اتركها فارغة للاحتفاظ بالصورة الحالية.</p>

                {{ Form::model($productImage,['method' => 'PUT', 'action' => ['App\Http\Controllers\Admin\ProductImageController@update', $productImage->id], 'files' => true]) }}
                <input type="hidden" name="product_id" value="{{ $productImage->product_id }}">

                {{-- الصورة --}}
                <div class="ff-card">
                    <div class="ff-card__head"><i class="fa fa-image"></i> صورة المنتج</div>
                    <div class="ff-grid">
                        <div class="ff-field ff-field--full">
                            <label>الصورة
                                <span class="opt">(اختياري — اتركها فارغة للاحتفاظ بالصورة الحالية)</span></label>
                            <input type="file" class="filestyle" data-placeholder="لم يتم اختيار ملف"
                                data-iconname="fa fa-cloud-upload" name="image">
                            <img class="ff-current-img"
                                src="{{ asset('admin_assets/images/products/' . $productImage->image) }}"
                                onerror="this.style.display='none'">
                            @if ($errors->has('image'))
                                <span class="ff-error">{{ $errors->first('image') }}</span>
                            @endif
                        </div>
                        <div class="ff-field ff-field--full">
                            <label>النص البديل للصورة (Alt) <span class="opt">(اختياري — مهم للـ SEO)</span></label>
                            <input type="text" class="ff-input" name="alt"
                                value="{{ old('alt', $productImage->alt) }}" placeholder="وصف قصير للصورة">
                            @if ($errors->has('alt'))
                                <span class="ff-error">{{ $errors->first('alt') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="ff-actions">
                    <button type="submit" class="ff-submit">حفظ التعديلات</button>
                </div>

                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>
@endsection
