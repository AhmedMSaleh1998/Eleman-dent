@extends('layouts.admin')

@section('styles')
    <!-- Plugins css-->
    <link href="{{ asset('admin_assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_assets/plugins/switchery/css/switchery.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_assets/plugins/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_assets/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('admin_assets/plugins/bootstrap-table/css/bootstrap-table.min.css') }}" rel="stylesheet"
        type="text/css" />
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
            <a style="color: #fff;" href="{{ route('admin.smsreminder.index') }}">/ رسائل التذكير / </a>
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
                <h4 class="header-title m-t-0 m-b-20" style="text-align:center;">
                    تعديل رسالة التذكير: {{ $smsreminder->name }}
                </h4>

                <div class="ff-wrap">
                    <p class="ff-note">الحقول المعلمة بعلامة <span style="color:#e74c3c; font-weight:bold;">*</span>
                        إجبارية ولا يمكن الحفظ بدونها.</p>

                    {{ Form::model($smsreminder, ['method' => 'PATCH', 'action' => ['App\Http\Controllers\Admin\SmsReminderController@update', $smsreminder->id], 'files' => true]) }}

                    {{-- بيانات المستلم --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-user"></i> بيانات المستلم</div>
                        <div class="ff-grid">
                            <div class="ff-field">
                                <label>الاسم <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="name" required
                                    value="{{ old('name', $smsreminder->name) }}">
                                @if ($errors->has('name'))
                                    <span class="ff-error">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>رقم الهاتف <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="phone" required dir="ltr"
                                    value="{{ old('phone', $smsreminder->phone) }}">
                                @if ($errors->has('phone'))
                                    <span class="ff-error">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- أنواع التذكير --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-bell"></i> أنواع التذكير
                            <small>اختر التنبيهات التي تريد إرسالها لهذا الرقم</small>
                        </div>
                        <div class="ff-grid">
                            <div class="ff-field">
                                <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                                    <input type="checkbox" class="checkbox checkbox-info checkbox-inline"
                                        id="notify_order" name="notify_order"
                                        {{ $smsreminder->notify_order == 1 ? 'checked' : '' }}>
                                    تذكير الطلبات <span class="opt">(اختياري)</span>
                                </label>
                                @if ($errors->has('notify_order'))
                                    <span class="ff-error">{{ $errors->first('notify_order') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                                    <input type="checkbox" class="checkbox checkbox-info checkbox-inline"
                                        id="notify_payment" name="notify_payment"
                                        {{ $smsreminder->notify_payment == 1 ? 'checked' : '' }}>
                                    تذكير الدفع <span class="opt">(اختياري)</span>
                                </label>
                                @if ($errors->has('notify_payment'))
                                    <span class="ff-error">{{ $errors->first('notify_payment') }}</span>
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
        </div><!-- end col -->
    </div>
@endsection
