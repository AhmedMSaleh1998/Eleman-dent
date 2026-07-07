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
            <a style="color: #fff;" href="{{ route('admin.delivertime.index') }}">/ مواعيد التوصيل / </a>
            <a style="color: #36404a;"> إضافة </a>

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
                <h4 class="header-title m-t-0 m-b-20" style="text-align:center;">إضافة موعد توصيل جديد</h4>

                <div class="ff-wrap">
                    <p class="ff-note">الحقول المعلمة بعلامة <span style="color:#e74c3c; font-weight:bold;">*</span>
                        إجبارية ولا يمكن الحفظ بدونها.</p>

                    {{ Form::open(['method' => 'POST', 'action' => ['App\Http\Controllers\Admin\DeliverTimeController@store'], 'files' => true]) }}
                    @csrf

                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-clock-o"></i> فترة التوصيل</div>
                        <div class="ff-grid">
                            <div class="ff-field">
                                <label>من الساعة <span class="req">*</span></label>
                                <input type="time" class="ff-input" name="from" required dir="ltr"
                                    value="{{ old('from') }}">
                                @if ($errors->has('from'))
                                    <span class="ff-error">{{ $errors->first('from') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>إلى الساعة <span class="req">*</span></label>
                                <input type="time" class="ff-input" name="to" required dir="ltr"
                                    value="{{ old('to') }}">
                                @if ($errors->has('to'))
                                    <span class="ff-error">{{ $errors->first('to') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="ff-actions">
                        <button type="submit" class="ff-submit">حفظ</button>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div><!-- end col -->
    </div>
@endsection
