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
            <a style="color: #fff;" href="{{ route('admin.coupon.index') }}">/ الكوبونات / </a>
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
                    تعديل الكوبون: {{ $coupon->name }}
                </h4>

                <div class="ff-wrap">
                    <p class="ff-note">الحقول المعلمة بعلامة <span style="color:#e74c3c; font-weight:bold;">*</span>
                        إجبارية ولا يمكن الحفظ بدونها.</p>

                    {{ Form::model($coupon, ['method' => 'PATCH', 'action' => ['App\Http\Controllers\Admin\CouponController@update', $coupon->id], 'files' => true]) }}

                    {{-- بيانات الكوبون --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-ticket"></i> بيانات الكوبون</div>
                        <div class="ff-grid">
                            <div class="ff-field">
                                <label>الاسم <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="name" required
                                    value="{{ old('name', $coupon->name) }}">
                                @if ($errors->has('name'))
                                    <span class="ff-error">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>الكود <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="code" required dir="ltr"
                                    value="{{ old('code', $coupon->code) }}">
                                @if ($errors->has('code'))
                                    <span class="ff-error">{{ $errors->first('code') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- قيمة الخصم --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-percent"></i> قيمة الخصم وشروط الاستخدام</div>
                        <div class="ff-grid">
                            <div class="ff-field">
                                <label>نوع الخصم <span class="req">*</span></label>
                                <select name="type" class="ff-input" required>
                                    <option value="1" {{ old('type', $coupon->type) == 1 ? 'selected' : '' }}>قيمة ثابتة</option>
                                    <option value="2" {{ old('type', $coupon->type) == 2 ? 'selected' : '' }}>نسبة مئوية %</option>
                                </select>
                                @if ($errors->has('type'))
                                    <span class="ff-error">{{ $errors->first('type') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>قيمة الخصم <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="value" required dir="ltr"
                                    value="{{ old('value', $coupon->value) }}">
                                @if ($errors->has('value'))
                                    <span class="ff-error">{{ $errors->first('value') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>عدد مرات الاستخدام <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="uses" required dir="ltr"
                                    value="{{ old('uses', $coupon->uses) }}">
                                @if ($errors->has('uses'))
                                    <span class="ff-error">{{ $errors->first('uses') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>الحد الأدنى لقيمة الطلب <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="min_total" required dir="ltr"
                                    value="{{ old('min_total', $coupon->min_total) }}">
                                @if ($errors->has('min_total'))
                                    <span class="ff-error">{{ $errors->first('min_total') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- فترة الصلاحية --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-calendar"></i> فترة الصلاحية</div>
                        <div class="ff-grid">
                            <div class="ff-field">
                                <label>متاح من تاريخ <span class="req">*</span></label>
                                <input type="date" class="ff-input" name="valid_from" required dir="ltr"
                                    value="{{ old('valid_from', $coupon->valid_from) }}">
                                @if ($errors->has('valid_from'))
                                    <span class="ff-error">{{ $errors->first('valid_from') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>متاح حتى تاريخ <span class="req">*</span></label>
                                <input type="date" class="ff-input" name="valid_to" required dir="ltr"
                                    value="{{ old('valid_to', $coupon->valid_to) }}">
                                @if ($errors->has('valid_to'))
                                    <span class="ff-error">{{ $errors->first('valid_to') }}</span>
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
