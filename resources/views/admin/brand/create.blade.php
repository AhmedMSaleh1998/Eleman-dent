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
            <a style="color: #fff;" href="{{ route('admin.brand.index') }}">/ البرندات / </a>
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
                <h4 class="header-title m-t-0 m-b-20" style="text-align:center;">إضافة برند جديد</h4>

                <div class="ff-wrap">
                    <p class="ff-note">الحقول المعلمة بعلامة <span style="color:#e74c3c; font-weight:bold;">*</span>
                        إجبارية ولا يمكن الحفظ بدونها.</p>

                    {{ Form::open(['method' => 'POST', 'action' => ['App\Http\Controllers\Admin\BrandController@store'], 'files' => true]) }}
                    @csrf

                    {{-- الصورة --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-image"></i> صورة البرند</div>
                        <div class="ff-grid">
                            <div class="ff-field ff-field--full">
                                <label>الصورة (اللوجو) <span class="req">*</span></label>
                                <input type="file" class="filestyle" data-placeholder="لم يتم اختيار ملف"
                                    data-iconname="fa fa-cloud-upload" name="image" required>
                                @if ($errors->has('image'))
                                    <span class="ff-error">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- الاسم --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-tag"></i> اسم البرند</div>
                        <div class="ff-grid">
                            <div class="ff-field">
                                <label>الاسم (عربي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="name_ar" required
                                    value="{{ old('name_ar') }}" placeholder="اسم البرند كما سيظهر في الموقع">
                                @if ($errors->has('name_ar'))
                                    <span class="ff-error">{{ $errors->first('name_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>الاسم (إنجليزي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="name_en" required dir="ltr"
                                    value="{{ old('name_en') }}" placeholder="Brand name as shown on the website">
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
                                <textarea class="ff-input" name="description_ar" rows="3" required
                                    placeholder="وصف يظهر في صفحة البرند">{{ old('description_ar') }}</textarea>
                                @if ($errors->has('description_ar'))
                                    <span class="ff-error">{{ $errors->first('description_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field ff-field--full">
                                <label>الوصف (إنجليزي) <span class="req">*</span></label>
                                <textarea class="ff-input" name="description_en" rows="3" required dir="ltr"
                                    placeholder="Description shown on the brand page">{{ old('description_en') }}</textarea>
                                @if ($errors->has('description_en'))
                                    <span class="ff-error">{{ $errors->first('description_en') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- SEO --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-search"></i> تحسين محركات البحث (SEO)
                            <small>هذه الحقول تظهر في نتائج بحث جوجل</small>
                        </div>
                        <div class="ff-grid">
                            <div class="ff-field">
                                <label>عنوان الصفحة SEO (عربي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="title_ar" required
                                    value="{{ old('title_ar') }}" placeholder="عنوان الصفحة في نتائج بحث جوجل">
                                @if ($errors->has('title_ar'))
                                    <span class="ff-error">{{ $errors->first('title_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>عنوان الصفحة SEO (إنجليزي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="title_en" required dir="ltr"
                                    value="{{ old('title_en') }}" placeholder="Page title in Google search results">
                                @if ($errors->has('title_en'))
                                    <span class="ff-error">{{ $errors->first('title_en') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>النص البديل للصورة (عربي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="alt_ar" required
                                    value="{{ old('alt_ar') }}" placeholder="وصف قصير لصورة البرند (مهم للـ SEO)">
                                @if ($errors->has('alt_ar'))
                                    <span class="ff-error">{{ $errors->first('alt_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>النص البديل للصورة (إنجليزي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="alt_en" required dir="ltr"
                                    value="{{ old('alt_en') }}" placeholder="Short description of the image (SEO)">
                                @if ($errors->has('alt_en'))
                                    <span class="ff-error">{{ $errors->first('alt_en') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>وصف الميتا SEO (عربي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="description_meta_ar" required
                                    value="{{ old('description_meta_ar') }}"
                                    placeholder="وصف مختصر يظهر في نتائج جوجل (حوالي 160 حرف)">
                                @if ($errors->has('description_meta_ar'))
                                    <span class="ff-error">{{ $errors->first('description_meta_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>وصف الميتا SEO (إنجليزي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="description_meta_en" required dir="ltr"
                                    value="{{ old('description_meta_en') }}"
                                    placeholder="Short description for Google results (~160 chars)">
                                @if ($errors->has('description_meta_en'))
                                    <span class="ff-error">{{ $errors->first('description_meta_en') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>الكلمات المفتاحية (عربي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="keywords_ar" required
                                    value="{{ old('keywords_ar') }}" placeholder="كلمات مفصولة بفواصل">
                                @if ($errors->has('keywords_ar'))
                                    <span class="ff-error">{{ $errors->first('keywords_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>الكلمات المفتاحية (إنجليزي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="keywords_en" required dir="ltr"
                                    value="{{ old('keywords_en') }}" placeholder="Comma separated keywords">
                                @if ($errors->has('keywords_en'))
                                    <span class="ff-error">{{ $errors->first('keywords_en') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>كلمات الميتا المفتاحية SEO (عربي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="keywords_meta_ar" required
                                    value="{{ old('keywords_meta_ar') }}" placeholder="كلمات الميتا مفصولة بفواصل">
                                @if ($errors->has('keywords_meta_ar'))
                                    <span class="ff-error">{{ $errors->first('keywords_meta_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>كلمات الميتا المفتاحية SEO (إنجليزي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="keywords_meta_en" required dir="ltr"
                                    value="{{ old('keywords_meta_en') }}" placeholder="Meta keywords, comma separated">
                                @if ($errors->has('keywords_meta_en'))
                                    <span class="ff-error">{{ $errors->first('keywords_meta_en') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="ff-actions">
                        <button type="submit" class="ff-submit">حفظ البرند</button>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div><!-- end col -->
    </div>
@endsection
