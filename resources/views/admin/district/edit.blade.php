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
        <a style="color: #fff;" href="{{ route('admin.district.index') }}">/ مناطق / </a>
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
            <h4 class="header-title m-t-0 m-b-20">تعديل منطقة</h4>

            <table class="table table-bordered table-striped">
                {{ Form::model($district, ['method' => 'PATCH', 'action' => ['App\Http\Controllers\Admin\DistrictController@update', $district->id], 'files' => true]) }}
                <tbody>
                    <tr>
                        <td>اسم عربي </td>
                        <td><input type="text" class="form-control" name="name_ar" required value="{{ $district->name_ar }}"></td>
                        @if ($errors->has('name_ar'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('name_ar') }}</strong>
                        </span>
                        @endif
                    </tr>

                    <tr>
                        <td>اسم انجليزي </td>
                        <td><input type="text" class="form-control" name="name_en" required value="{{ $district->name_en }}"></td>
                        @if ($errors->has('name_en'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('name_en') }}</strong>
                        </span>
                        @endif
                    </tr>

                    <tr>
                        <td>مصاريف الشحن </td>
                        <td><input type="number" class="form-control" name="shipping_fees" required value="{{ $district->shipping_fees }}"></td>
                        @if ($errors->has('shipping_fees'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('shipping_fees') }}</strong>
                        </span>
                        @endif
                    </tr>
                    <tr>
                        <td style="width:25%"></td>
                        <td><button type="submit" class="btn btn-default waves-effect waves-light form-control">تعديل</button></td>
                    </tr>
                </tbody>
                {!! Form::close() !!}
            </table>
        </div>
    </div><!-- end col -->
</div>
@endsection