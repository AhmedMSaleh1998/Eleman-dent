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
            <a style="color: #fff;" href="{{ route('admin.event.index') }}">/ الأحداث / </a>
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
                    تعديل الحدث: {{ optional($event->translate('ar'))->name }}
                </h4>

                <div class="ff-wrap">
                    <p class="ff-note">الحقول المعلمة بعلامة <span style="color:#e74c3c; font-weight:bold;">*</span>
                        إجبارية ولا يمكن الحفظ بدونها — الصورة اختيارية.</p>

                    {{ Form::model($event, ['method' => 'PATCH', 'action' => ['App\Http\Controllers\Admin\EventController@update', $event->id], 'files' => true]) }}

                    {{-- الوسيط الرئيسي: صورة أو فيديو --}}
                    @include('admin.event._media_field', ['event' => $event, 'required' => false])

                    {{-- الاسم --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-tag"></i> اسم الحدث</div>
                        <div class="ff-grid">
                            <div class="ff-field">
                                <label>الاسم (عربي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="name_ar" required
                                    value="{{ old('name_ar', $event->translate('ar')->name) }}">
                                @if ($errors->has('name_ar'))
                                    <span class="ff-error">{{ $errors->first('name_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>الاسم (إنجليزي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="name_en" required dir="ltr"
                                    value="{{ old('name_en', $event->translate('en')->name) }}">
                                @if ($errors->has('name_en'))
                                    <span class="ff-error">{{ $errors->first('name_en') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- الوصف --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-align-right"></i> الوصف</div>
                        <div class="ff-grid">
                            <div class="ff-field ff-field--full">
                                <label>الوصف (عربي) <span class="req">*</span></label>
                                <textarea class="ff-input" name="description_ar" rows="3" required>{{ old('description_ar', $event->translate('ar')->description) }}</textarea>
                                @if ($errors->has('description_ar'))
                                    <span class="ff-error">{{ $errors->first('description_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field ff-field--full">
                                <label>الوصف (إنجليزي) <span class="req">*</span></label>
                                <textarea class="ff-input" name="description_en" rows="3" required dir="ltr">{{ old('description_en', $event->translate('en')->description) }}</textarea>
                                @if ($errors->has('description_en'))
                                    <span class="ff-error">{{ $errors->first('description_en') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- المكان والتاريخ --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-map-marker"></i> المكان والتاريخ</div>
                        <div class="ff-grid">
                            <div class="ff-field">
                                <label>المكان (عربي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="location_ar" required
                                    value="{{ old('location_ar', $event->translate('ar')->location) }}">
                                @if ($errors->has('location_ar'))
                                    <span class="ff-error">{{ $errors->first('location_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>المكان (إنجليزي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="location_en" required dir="ltr"
                                    value="{{ old('location_en', $event->translate('en')->location) }}">
                                @if ($errors->has('location_en'))
                                    <span class="ff-error">{{ $errors->first('location_en') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label for="date">التاريخ <span class="req">*</span></label>
                                <input type="date" class="ff-input" id="date" name="date" required dir="ltr"
                                    value="{{ old('date', $event->date) }}">
                                @if ($errors->has('date'))
                                    <span class="ff-error">{{ $errors->first('date') }}</span>
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
