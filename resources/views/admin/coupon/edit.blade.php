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
        <a style="coupon: #fff;" href="{{ route('admin.home') }}">الرئيسية</a>
        <a style="coupon: #fff;" href="{{ route('admin.coupon.index') }}">/ كوبونات / </a>
        <a style="coupon: #36404a;"> تعديل </a>

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
            <h4 class="header-title m-t-0 m-b-20">تعديل كوبون</h4>

            <table class="table table-bordered table-striped">
                {{ Form::model($coupon, ['method' => 'PATCH', 'action' => ['App\Http\Controllers\Admin\CouponController@update', $coupon->id], 'files' => true]) }}
                <tbody>
                    <tr>
                        <td>اسم </td>
                        <td><input type="text" class="form-control" name="name" required value="{{ $coupon->name }}"></td>
                        @if ($errors->has('name'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </tr>
                    <tr>
                        <td>الكود</td>
                        <td><input type="text" class="form-control" name="code" required value="{{ $coupon->code }}"></td>
                        @if ($errors->has('code'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('code') }}</strong>
                        </span>
                        @endif
                    </tr>
                    <tr>
                        <td>القيمة</td>
                        <td><input type="text" class="form-control" name="value" required value="{{ $coupon->value }}"></td>
                        @if ($errors->has('value'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('value') }}</strong>
                        </span>
                        @endif
                    </tr>
                    <tr>
                        <td>النوع</td>
                        <td>
                            <select name="type" class="form-control" required value="{{ $coupon->type}}">
                                <option value="1" {{$coupon->type == 1 ? 'selected' : ''}}>قيمة ثابتة</option>
                                <option value="2" {{$coupon->type == 2 ? 'selected' : ''}}>نسبة مئوية %</option>
                            </select>
                        </td>
                        @if ($errors->has('type'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('type') }}</strong>
                        </span>
                        @endif
                    </tr>
                    <tr>
                        <td>مرات الاستخدام</td>
                        <td><input type="text" class="form-control" name="uses" required value="{{ $coupon->uses }}"></td>
                        @if ($errors->has('uses'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('uses') }}</strong>
                        </span>
                        @endif
                    </tr>
                    <tr>
                        <td>أقل قيمة لتطبيق الكوبون</td>
                        <td><input type="text" class="form-control" name="min_total" required value="{{ $coupon->min_total }}"></td>
                        @if ($errors->has('min_total'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('min_total') }}</strong>
                        </span>
                        @endif
                    </tr>
                    <tr>
                        <td>متاح منذ</td>
                        <td>
                            <input type="date" class="form-control" name="valid_from" required value="{{ $coupon->valid_from }}">
                        </td>
                        @if ($errors->has('valid_from'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('valid_from') }}</strong>
                        </span>
                        @endif
                    </tr>
                    <tr>
                        <td>متاح حتي</td>
                        <td>
                            <input type="date" class="form-control" name="valid_to" value="{{ $coupon->valid_to }}" required>
                        </td>
                        @if ($errors->has('valid_to'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('valid_to') }}</strong>
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