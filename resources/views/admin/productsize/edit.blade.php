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
@endsection

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
        <a style="color: #fff;" href="{{ route('admin.productsize.index' , $productsize->product_id) }}">/ مقاسات المنتج / </a>
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
            <h4 class="header-title m-t-0 m-b-20">تعديل مقاس المنتج</h4>
            {{ Form::model($productsize,['method' => 'PUT', 'action' => ['App\Http\Controllers\Admin\ProductSizeController@update', $productsize->id], 'files' => true]) }}
            <table class="table table-bordered table-striped">
                <tbody>
                    <input type="hidden" name="product_id" value="{{ $productsize->product_id}}">
                    <tr>
                        <td>الاسم عربي</td>
                        <td><input type="text" class="form-control" name="name_ar" required
                                value="{{ $productsize->name_ar }}"></td>
                        @if ($errors->has('name_ar'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('name_ar') }}</strong>
                            </span>
                        @endif
                    </tr>
                    <tr>
                        <td>الاسم انجليزى</td>
                        <td><input type="text" class="form-control" name="name_en" required
                                value="{{ $productsize->name_en }}"></td>
                        @if ($errors->has('name_en'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('title_en') }}</strong>
                            </span>
                        @endif
                    </tr>
                    <tr>
                        <td>السعر</td>
                        <td><input type="number" class="form-control" name="price" required
                                value="{{ $productsize->price }}"></td>
                        @if ($errors->has('price'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('price') }}</strong>
                            </span>
                        @endif
                    </tr>
                    <tr>
                        <td>السعر بعد الخصم</td>
                        <td><input type="number" class="form-control" name="discount_price" required
                                value="{{ $productsize->discount_price }}"></td>
                        @if ($errors->has('discount_price'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('discount_price') }}</strong>
                            </span>
                        @endif
                    </tr>
                    <tr>
                        <td style="width:25%"></td>
                        <td><button type="submit" class="btn btn-default waves-effect waves-light form-control">حفظ</button></td>
                    </tr>
                </tbody>
            </table>
            {!! Form::close() !!}

        </div>
    </div>
</div>
@endsection
