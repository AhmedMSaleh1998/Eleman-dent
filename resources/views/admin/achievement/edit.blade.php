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
            <a style="color: #fff;" href="{{ route('admin.achievement.index') }}">/ الانجازات / </a>
            <a style="color: #36404a;"> تعديل </a>

        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="header-title m-t-0 m-b-20" style="text-align:center;">
                    تعديل الانجاز: {{ optional($achievement->translate('ar'))->name }}
                </h4>

                <div class="ff-wrap">
                    <p class="ff-note">الحقول المعلمة بعلامة <span style="color:#e74c3c; font-weight:bold;">*</span>
                        إجبارية ولا يمكن الحفظ بدونها — الصورة اختيارية.</p>

                    {{ Form::model($achievement, ['method' => 'PATCH', 'action' => ['App\Http\Controllers\Admin\AchievementController@update', $achievement->id], 'files' => true]) }}

                    {{-- الصورة --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-image"></i> صورة الانجاز</div>
                        <div class="ff-grid">
                            <div class="ff-field ff-field--full">
                                <label>الصورة
                                    <span class="opt">(اختياري — اتركها فارغة للاحتفاظ بالصورة الحالية)</span></label>
                                <input type="file" class="filestyle" data-placeholder="لم يتم اختيار ملف"
                                    data-iconname="fa fa-cloud-upload" name="image">
                                <img class="ff-current-img"
                                    src="{{ asset('admin_assets/images/achievements/' . $achievement->image) }}"
                                    onerror="this.style.display='none'">
                                @if ($errors->has('image'))
                                    <span class="ff-error">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- الاسم --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-tag"></i> اسم الانجاز</div>
                        <div class="ff-grid">
                            <div class="ff-field">
                                <label>الاسم (عربي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="name_ar" required
                                    value="{{ old('name_ar', $achievement->translate('ar')->name) }}">
                                @if ($errors->has('name_ar'))
                                    <span class="ff-error">{{ $errors->first('name_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>الاسم (إنجليزي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="name_en" required dir="ltr"
                                    value="{{ old('name_en', $achievement->translate('en')->name) }}">
                                @if ($errors->has('name_en'))
                                    <span class="ff-error">{{ $errors->first('name_en') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- القيمة --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-line-chart"></i> قيمة الانجاز</div>
                        <div class="ff-grid">
                            <div class="ff-field ff-field--full">
                                <label>القيمة (رقم) <span class="req">*</span></label>
                                <input type="number" step="1" class="ff-input" name="value" required dir="ltr"
                                    value="{{ old('value', $achievement->value) }}">
                                @if ($errors->has('value'))
                                    <span class="ff-error">{{ $errors->first('value') }}</span>
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
