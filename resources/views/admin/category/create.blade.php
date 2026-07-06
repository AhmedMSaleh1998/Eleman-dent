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
                <h4 class="header-title m-t-0 m-b-20">إضافة قسم جديد</h4>
                <p style="background:#fdf3f2; border:1px solid #f5c6cb; border-radius:6px; padding:8px 14px; font-size:13px; margin-bottom:15px;">الحقول المعلمة بعلامة <span style="color:#e74c3c; font-weight:bold;">*</span> إجبارية ولا يمكن الحفظ بدونها — حقل "القسم الأب" فقط اختياري.</p>

                <table class="table table-bordered table-striped">
                    {{ Form::open(['method' => 'POST', 'action' => ['App\Http\Controllers\Admin\CategoryController@store'], 'files' => true]) }}
                    @csrf
                    <tbody>

                        <tr>
                            <td>القسم الأب <small style="color:#7a8791; font-weight:normal;">(اختياري)</small></td>
                            <td>
                                <select name="parent_id" class="form-control">
                                    <option value="">— قسم رئيسي (بدون قسم أب) —</option>
                                    @foreach ($parents as $parent)
                                        <option value="{{ $parent['id'] }}"
                                            {{ (string) old('parent_id', $selectedParent ?? '') === (string) $parent['id'] ? 'selected' : '' }}>
                                            {!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $parent['depth']) !!}{{ $parent['depth'] > 0 ? '↳ ' : '' }}{{ $parent['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('parent_id'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('parent_id') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>الصورة (اللوجو) <span style="color:#e74c3c; font-weight:bold;">*</span></td>
                            <td>
                                <input type="file" class="filestyle" data-placeholder="لم يتم اختيار ملف"
                                    data-iconname="fa fa-cloud-upload" name="image" required>
                                @if ($errors->has('image'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif

                            </td>
                        </tr>
                        <tr>
                            <td>الاسم (عربي) <span style="color:#e74c3c; font-weight:bold;">*</span></td>
                            <td><input type="text" class="form-control" name="name_ar" required placeholder="اسم القسم كما سيظهر في الموقع"></td>
                            @if ($errors->has('name_ar'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('name_ar') }}</strong>
                                </span>
                            @endif
                        </tr>
                        <tr>
                            <td>الاسم (إنجليزي) <span style="color:#e74c3c; font-weight:bold;">*</span></td>
                            <td><input type="text" class="form-control" name="name_en" required placeholder="Category name as shown on the website"></td>
                            @if ($errors->has('name_en'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('name_en') }}</strong>
                                </span>
                            @endif
                        </tr>
                        <tr>
                            <td>عنوان الصفحة SEO (عربي) <span style="color:#e74c3c; font-weight:bold;">*</span></td>
                            <td><input type="text" class="form-control" name="title_ar" required placeholder="عنوان الصفحة في نتائج بحث جوجل"></td>
                            @if ($errors->has('title_ar'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('title_ar') }}</strong>
                                </span>
                            @endif
                        </tr>
                        <tr>
                            <td>عنوان الصفحة SEO (إنجليزي) <span style="color:#e74c3c; font-weight:bold;">*</span></td>
                            <td><input type="text" class="form-control" name="title_en" required placeholder="Page title in Google search results"></td>
                            @if ($errors->has('title_en'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('title_en') }}</strong>
                                </span>
                            @endif
                        </tr>
                        <tr>
                            <td>النص البديل للصورة (عربي) <span style="color:#e74c3c; font-weight:bold;">*</span></td>
                            <td><input type="text" class="form-control" name="alt_ar" required placeholder="وصف قصير لصورة القسم (مهم للـ SEO)"></td>
                            @if ($errors->has('alt_ar'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('alt_ar') }}</strong>
                                </span>
                            @endif
                        </tr>
                        <tr>
                            <td>النص البديل للصورة (إنجليزي) <span style="color:#e74c3c; font-weight:bold;">*</span></td>
                            <td><input type="text" class="form-control" name="alt_en" required placeholder="Short description of the image (SEO)"></td>
                            @if ($errors->has('alt_en'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('alt_en') }}</strong>
                                </span>
                            @endif
                        </tr>
                        <tr>
                            <td>الوصف (عربي) <span style="color:#e74c3c; font-weight:bold;">*</span></td>
                            <td><input type="text" class="form-control" name="description_ar" required placeholder="وصف يظهر أعلى صفحة القسم في الموقع"></td>
                            @if ($errors->has('description_ar'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('description_ar') }}</strong>
                                </span>
                            @endif
                        </tr>
                        <tr>
                            <td>الوصف (إنجليزي) <span style="color:#e74c3c; font-weight:bold;">*</span></td>
                            <td><input type="text" class="form-control" name="description_en" required placeholder="Description shown on the category page"></td>
                            @if ($errors->has('description_en'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('description_en') }}</strong>
                                </span>
                            @endif
                        </tr>
                        <tr>
                            <td>وصف الميتا SEO (عربي) <span style="color:#e74c3c; font-weight:bold;">*</span></td>
                            <td><input type="text" class="form-control" name="description_meta_ar" required placeholder="وصف مختصر يظهر في نتائج جوجل (حوالي 160 حرف)"></td>
                            @if ($errors->has('description_meta_ar'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('description_meta_ar') }}</strong>
                                </span>
                            @endif
                        </tr>
                        <tr>
                            <td>وصف الميتا SEO (إنجليزي) <span style="color:#e74c3c; font-weight:bold;">*</span></td>
                            <td><input type="text" class="form-control" name="description_meta_en" required placeholder="Short description for Google results (~160 chars)"></td>
                            @if ($errors->has('description_meta_en'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('description_meta_en') }}</strong>
                                </span>
                            @endif
                        </tr>
                        <tr>
                            <td>الكلمات المفتاحية (عربي) <span style="color:#e74c3c; font-weight:bold;">*</span></td>
                            <td><input type="text" class="form-control" name="keywords_ar" required placeholder="كلمات مفصولة بفواصل: تعقيم, أجهزة, أسنان"></td>
                            @if ($errors->has('keywords_ar'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('keywords_ar') }}</strong>
                                </span>
                            @endif
                        </tr>
                        <tr>
                            <td>الكلمات المفتاحية (إنجليزي) <span style="color:#e74c3c; font-weight:bold;">*</span></td>
                            <td><input type="text" class="form-control" name="keywords_en" required placeholder="Comma separated: sterilization, devices"></td>
                            @if ($errors->has('keywords_en'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('keywords_en') }}</strong>
                                </span>
                            @endif
                        </tr>
                        <tr>
                            <td>كلمات الميتا المفتاحية SEO (عربي) <span style="color:#e74c3c; font-weight:bold;">*</span></td>
                            <td><input type="text" class="form-control" name="keywords_meta_ar" required placeholder="كلمات الميتا مفصولة بفواصل"></td>
                            @if ($errors->has('keywords_meta_ar'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('keywords_meta_ar') }}</strong>
                                </span>
                            @endif
                        </tr>
                        <tr>
                            <td>كلمات الميتا المفتاحية SEO (إنجليزي) <span style="color:#e74c3c; font-weight:bold;">*</span></td>
                            <td><input type="text" class="form-control" name="keywords_meta_en" required placeholder="Meta keywords, comma separated"></td>
                            @if ($errors->has('keywords_meta_en'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('keywords_meta_en') }}</strong>
                                </span>
                            @endif
                        </tr>
                        <tr>
                            <td style="width:25%"></td>
                            <td><button type="submit"
                                    class="btn btn-default waves-effect waves-light form-control">حفظ</button></td>
                        </tr>
                    </tbody>
                    {{-- </form> --}}
                    {!! Form::close() !!}
                </table>
            </div>
        </div><!-- end col -->
    </div>
@endsection
