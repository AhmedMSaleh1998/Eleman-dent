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
            <a style="color: #fff;" href="{{ route('admin.product.index') }}">/ المنتجات / </a>
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
                    تعديل المنتج: {{ optional($product->translate('ar'))->name }}
                </h4>

                <div class="ff-wrap">
                    <p class="ff-note">الحقول المعلمة بعلامة <span style="color:#e74c3c; font-weight:bold;">*</span>
                        إجبارية ولا يمكن الحفظ بدونها — الصورة والملفات اختيارية.</p>

                    {{ Form::model($product, ['method' => 'PATCH', 'action' => ['App\Http\Controllers\Admin\ProductController@update', $product->id], 'files' => true]) }}
                    @csrf
                    @method('PUT')

                    {{-- الصور والملفات --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-image"></i> الصور والملفات</div>
                        <div class="ff-grid">
                            <div class="ff-field ff-field--full">
                                <label>صورة المنتج الرئيسية
                                    <span class="opt">(اختياري — اتركها فارغة للاحتفاظ بالصورة الحالية)</span></label>
                                <input type="file" class="filestyle" data-placeholder="لم يتم اختيار ملف"
                                    data-iconname="fa fa-cloud-upload" name="image">
                                <img class="ff-current-img"
                                    src="{{ asset('admin_assets/images/products/' . $product->image) }}"
                                    onerror="this.style.display='none'">
                                @if ($errors->has('image'))
                                    <span class="ff-error">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>كتالوج PDF
                                    <span class="opt">(اختياري — اتركه فارغاً للاحتفاظ بالملف الحالي)</span></label>
                                <input type="file" class="filestyle" data-placeholder="لم يتم اختيار ملف"
                                    data-iconname="fa fa-cloud-upload" name="pdf">
                                @if ($product->pdf)
                                    <a href="{{ asset('admin_assets/images/product_pdfs/' . $product->pdf) }}"
                                        target="_blank" style="display:inline-block; margin-top:8px;">
                                        <i class="fa fa-file-pdf-o"></i> عرض الملف الحالي</a>
                                @else
                                    <span class="opt" style="display:block; margin-top:8px;">لا يوجد ملف PDF حالياً</span>
                                @endif
                                @if ($errors->has('pdf'))
                                    <span class="ff-error">{{ $errors->first('pdf') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>رابط الفيديو <span class="opt">(اختياري)</span></label>
                                <input type="url" class="ff-input" name="video_url" dir="ltr"
                                    value="{{ old('video_url', $product->video_url) }}"
                                    placeholder="https://www.youtube.com/watch?v=...">
                                @if ($errors->has('video_url'))
                                    <span class="ff-error">{{ $errors->first('video_url') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- البيانات الأساسية --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-tag"></i> البيانات الأساسية</div>
                        <div class="ff-grid">
                            <div class="ff-field">
                                <label>اسم المنتج (عربي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="name_ar" required
                                    value="{{ old('name_ar', $product->translate('ar')->name) }}">
                                @if ($errors->has('name_ar'))
                                    <span class="ff-error">{{ $errors->first('name_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>اسم المنتج (إنجليزي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="name_en" required dir="ltr"
                                    value="{{ old('name_en', $product->translate('en')->name) }}">
                                @if ($errors->has('name_en'))
                                    <span class="ff-error">{{ $errors->first('name_en') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>القسم <span class="req">*</span>
                                    <span class="opt">(يمكن اختيار أكثر من قسم — اضغط Ctrl مع النقر)</span></label>
                                <select name="category_id[]" id="category" class="form-control ff-input" multiple>
                                    @foreach ($data['categories'] as $category)
                                        <option value="{{ $category->id }}"
                                            {{ in_array($category->id, old('category_id', $product->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                                            {{ $category->translate('ar')->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                    <span class="ff-error">{{ $errors->first('category_id') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>البرند <span class="opt">(اختياري)</span></label>
                                <select name="brand_id" id="brand" class="form-control ff-input">
                                    <option value=""> اختر البرند </option>
                                    @foreach ($data['brands'] as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->translate('ar')->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('brand_id'))
                                    <span class="ff-error">{{ $errors->first('brand_id') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>الترتيب <span class="req">*</span></label>
                                <input type="number" class="ff-input" name="seq" required dir="ltr"
                                    value="{{ old('seq', $product->seq) }}">
                                @if ($errors->has('seq'))
                                    <span class="ff-error">{{ $errors->first('seq') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- السعر والمخزون --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-money"></i> السعر والمخزون</div>
                        <div class="ff-grid">
                            <div class="ff-field">
                                <label>السعر <span class="req">*</span></label>
                                <input type="number" class="ff-input" name="price" dir="ltr"
                                    value="{{ old('price', $product->price) }}">
                                @if ($errors->has('price'))
                                    <span class="ff-error">{{ $errors->first('price') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>سعر الخصم <span class="opt">(اختياري)</span></label>
                                <input type="number" class="ff-input" name="discount_price" dir="ltr"
                                    value="{{ old('discount_price', $product->discount_price) }}">
                                @if ($errors->has('discount_price'))
                                    <span class="ff-error">{{ $errors->first('discount_price') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>الكمية <span class="req">*</span></label>
                                <input type="number" class="ff-input" name="quantity" dir="ltr"
                                    value="{{ old('quantity', $product->quantity) }}">
                                @if ($errors->has('quantity'))
                                    <span class="ff-error">{{ $errors->first('quantity') }}</span>
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
                                <textarea name="description_ar" class="ff-input" id="content2" rows="4">{{ old('description_ar', $product->description ?? '') }}</textarea>
                                @if ($errors->has('description_ar'))
                                    <span class="ff-error">{{ $errors->first('description_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field ff-field--full">
                                <label>الوصف (إنجليزي) <span class="req">*</span></label>
                                <textarea name="description_en" class="ff-input" rows="4" dir="ltr">{{ old('description_en', $product->description ?? '') }}</textarea>
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
                                    value="{{ old('title_ar', $product->translate('ar')->title) }}">
                                @if ($errors->has('title_ar'))
                                    <span class="ff-error">{{ $errors->first('title_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>عنوان الصفحة SEO (إنجليزي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="title_en" required dir="ltr"
                                    value="{{ old('title_en', $product->translate('en')->title) }}">
                                @if ($errors->has('title_en'))
                                    <span class="ff-error">{{ $errors->first('title_en') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>النص البديل للصورة (عربي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="alt_ar" required
                                    value="{{ old('alt_ar', $product->translate('ar')->alt) }}">
                                @if ($errors->has('alt_ar'))
                                    <span class="ff-error">{{ $errors->first('alt_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>النص البديل للصورة (إنجليزي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="alt_en" required dir="ltr"
                                    value="{{ old('alt_en', $product->translate('en')->alt) }}">
                                @if ($errors->has('alt_en'))
                                    <span class="ff-error">{{ $errors->first('alt_en') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>وصف الميتا SEO (عربي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="description_meta_ar" required
                                    value="{{ old('description_meta_ar', $product->translate('ar')->description_meta) }}">
                                @if ($errors->has('description_meta_ar'))
                                    <span class="ff-error">{{ $errors->first('description_meta_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>وصف الميتا SEO (إنجليزي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="description_meta_en" required dir="ltr"
                                    value="{{ old('description_meta_en', $product->translate('en')->description_meta) }}">
                                @if ($errors->has('description_meta_en'))
                                    <span class="ff-error">{{ $errors->first('description_meta_en') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>الكلمات المفتاحية (عربي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="keywords_ar" required
                                    value="{{ old('keywords_ar', $product->translate('ar')->keywords) }}">
                                @if ($errors->has('keywords_ar'))
                                    <span class="ff-error">{{ $errors->first('keywords_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>الكلمات المفتاحية (إنجليزي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="keywords_en" required dir="ltr"
                                    value="{{ old('keywords_en', $product->translate('en')->keywords) }}">
                                @if ($errors->has('keywords_en'))
                                    <span class="ff-error">{{ $errors->first('keywords_en') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>كلمات الميتا المفتاحية SEO (عربي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="keywords_meta_ar" required
                                    value="{{ old('keywords_meta_ar', $product->translate('ar')->keywords_meta) }}">
                                @if ($errors->has('keywords_meta_ar'))
                                    <span class="ff-error">{{ $errors->first('keywords_meta_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>كلمات الميتا المفتاحية SEO (إنجليزي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="keywords_meta_en" required dir="ltr"
                                    value="{{ old('keywords_meta_en', $product->translate('en')->keywords_meta) }}">
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

@section('scripts')
    <script>
        $('document').ready(function() {
            $(".isDiscount").change(function() {
                if (this.checked) {
                    $('.discount').css('display', 'table-row');
                } else {
                    $('.discount').css('display', 'none');
                }
            });
        });
    </script>
@endsection
