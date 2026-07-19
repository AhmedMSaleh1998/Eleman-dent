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
            <a style="color: #fff;" href="{{ route('admin.category.index') }}">/ الأقسام / </a>
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
                    تعديل القسم: {{ optional($category->translate('ar'))->name }}
                </h4>

                <div class="ff-wrap">
                    <p class="ff-note">الحقول المعلمة بعلامة <span style="color:#e74c3c; font-weight:bold;">*</span>
                        إجبارية ولا يمكن الحفظ بدونها — "القسم الأب" والصورة اختياريان.</p>

                    {{ Form::model($category, ['method' => 'PATCH', 'action' => ['App\Http\Controllers\Admin\CategoryController@update', $category->id], 'files' => true]) }}

                    {{-- الهيكل والصورة --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-sitemap"></i> الهيكل والصورة</div>
                        <div class="ff-grid">
                            <div class="ff-field">
                                <label>القسم الأب <span class="opt">(اختياري — اتركه "رئيسي" إذا لم يكن قسماً
                                        فرعياً)</span></label>
                                <select name="parent_id" class="ff-input">
                                    <option value="">— قسم رئيسي (بدون قسم أب) —</option>
                                    @foreach ($parents as $parent)
                                        <option value="{{ $parent['id'] }}"
                                            {{ (string) old('parent_id', $category->parent_id) === (string) $parent['id'] ? 'selected' : '' }}>
                                            {!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $parent['depth']) !!}{{ $parent['depth'] > 0 ? '↳ ' : '' }}{{ $parent['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('parent_id'))
                                    <span class="ff-error">{{ $errors->first('parent_id') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>الصورة (اللوجو)
                                    <span class="opt">(اختياري — اتركها فارغة للاحتفاظ بالصورة الحالية)</span></label>
                                <input type="file" class="filestyle" data-placeholder="لم يتم اختيار ملف"
                                    data-iconname="fa fa-cloud-upload" name="image">
                                <img class="ff-current-img"
                                    src="{{ asset('admin_assets/images/categories/' . $category->image) }}"
                                    onerror="this.style.display='none'">
                                @if ($errors->has('image'))
                                    <span class="ff-error">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                            <div class="ff-field ff-field--full">
                                <label>بانر الصفحة
                                    <span class="opt">(اختياري — صورة عريضة تظهر كخلفية أعلى صفحة القسم في الموقع، يفضل
                                        1600×400)</span></label>
                                <input type="file" class="filestyle" data-placeholder="لم يتم اختيار ملف"
                                    data-iconname="fa fa-cloud-upload" name="banner">
                                @if ($category->banner)
                                    <img class="ff-current-img" style="width:100%; max-width:420px; height:auto;"
                                        src="{{ asset('admin_assets/images/categories/banners/' . $category->banner) }}"
                                        onerror="this.style.display='none'">
                                @endif
                                @if ($errors->has('banner'))
                                    <span class="ff-error">{{ $errors->first('banner') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- الظهور في الصفحة الرئيسية --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-home"></i> الظهور في الصفحة الرئيسية
                            <small>يتحكم في شريط "تصفح حسب الفئة" أعلى الصفحة الرئيسية</small>
                        </div>
                        <div class="ff-grid">
                            <div class="ff-field">
                                <label>
                                    <input type="checkbox" name="show_in_home" value="1"
                                        {{ old('show_in_home', $category->show_in_home) ? 'checked' : '' }}>
                                    إظهار هذا القسم في الصفحة الرئيسية
                                </label>
                                <span class="opt">(إذا لم تختر أي قسم, تظهر كل الأقسام الرئيسية حسب الترتيب)</span>
                            </div>
                            <div class="ff-field">
                                <label>ترتيب الظهور <span class="opt">(اختياري — الأصغر يظهر أولاً)</span></label>
                                <input type="number" min="0" class="ff-input" name="home_order"
                                    value="{{ old('home_order', $category->home_order) }}" placeholder="مثال: 1">
                                @if ($errors->has('home_order'))
                                    <span class="ff-error">{{ $errors->first('home_order') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- الاسم --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-tag"></i> اسم القسم</div>
                        <div class="ff-grid">
                            <div class="ff-field">
                                <label>الاسم (عربي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="name_ar" required
                                    value="{{ old('name_ar', $category->translate('ar')->name) }}">
                                @if ($errors->has('name_ar'))
                                    <span class="ff-error">{{ $errors->first('name_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>الاسم (إنجليزي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="name_en" required dir="ltr"
                                    value="{{ old('name_en', $category->translate('en')->name) }}">
                                @if ($errors->has('name_en'))
                                    <span class="ff-error">{{ $errors->first('name_en') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- الوصف --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-align-right"></i> الوصف
                            <small>يظهر أعلى صفحة القسم في الموقع</small>
                        </div>
                        <div class="ff-grid">
                            <div class="ff-field ff-field--full">
                                <label>الوصف (عربي) <span class="req">*</span></label>
                                <textarea class="ff-input" name="description_ar" rows="3" required>{{ old('description_ar', $category->translate('ar')->description) }}</textarea>
                                @if ($errors->has('description_ar'))
                                    <span class="ff-error">{{ $errors->first('description_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field ff-field--full">
                                <label>الوصف (إنجليزي) <span class="req">*</span></label>
                                <textarea class="ff-input" name="description_en" rows="3" required dir="ltr">{{ old('description_en', $category->translate('en')->description) }}</textarea>
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
                                    value="{{ old('title_ar', $category->translate('ar')->title) }}">
                                @if ($errors->has('title_ar'))
                                    <span class="ff-error">{{ $errors->first('title_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>عنوان الصفحة SEO (إنجليزي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="title_en" required dir="ltr"
                                    value="{{ old('title_en', $category->translate('en')->title) }}">
                                @if ($errors->has('title_en'))
                                    <span class="ff-error">{{ $errors->first('title_en') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>النص البديل للصورة (عربي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="alt_ar" required
                                    value="{{ old('alt_ar', $category->translate('ar')->alt) }}">
                                @if ($errors->has('alt_ar'))
                                    <span class="ff-error">{{ $errors->first('alt_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>النص البديل للصورة (إنجليزي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="alt_en" required dir="ltr"
                                    value="{{ old('alt_en', $category->translate('en')->alt) }}">
                                @if ($errors->has('alt_en'))
                                    <span class="ff-error">{{ $errors->first('alt_en') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>وصف الميتا SEO (عربي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="description_meta_ar" required
                                    value="{{ old('description_meta_ar', $category->translate('ar')->description_meta) }}">
                                @if ($errors->has('description_meta_ar'))
                                    <span class="ff-error">{{ $errors->first('description_meta_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>وصف الميتا SEO (إنجليزي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="description_meta_en" required dir="ltr"
                                    value="{{ old('description_meta_en', $category->translate('en')->description_meta) }}">
                                @if ($errors->has('description_meta_en'))
                                    <span class="ff-error">{{ $errors->first('description_meta_en') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>الكلمات المفتاحية (عربي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="keywords_ar" required
                                    value="{{ old('keywords_ar', $category->translate('ar')->keywords) }}">
                                @if ($errors->has('keywords_ar'))
                                    <span class="ff-error">{{ $errors->first('keywords_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>الكلمات المفتاحية (إنجليزي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="keywords_en" required dir="ltr"
                                    value="{{ old('keywords_en', $category->translate('en')->keywords) }}">
                                @if ($errors->has('keywords_en'))
                                    <span class="ff-error">{{ $errors->first('keywords_en') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>كلمات الميتا المفتاحية SEO (عربي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="keywords_meta_ar" required
                                    value="{{ old('keywords_meta_ar', $category->translate('ar')->keywords_meta) }}">
                                @if ($errors->has('keywords_meta_ar'))
                                    <span class="ff-error">{{ $errors->first('keywords_meta_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>كلمات الميتا المفتاحية SEO (إنجليزي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="keywords_meta_en" required dir="ltr"
                                    value="{{ old('keywords_meta_en', $category->translate('en')->keywords_meta) }}">
                                @if ($errors->has('keywords_meta_en'))
                                    <span class="ff-error">{{ $errors->first('keywords_meta_en') }}</span>
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
