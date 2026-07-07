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
            <a style="color: #fff;" href="{{ route('admin.certificate.index') }}">/ الشهادات / </a>
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
                <h4 class="header-title m-t-0 m-b-20" style="text-align:center;">إضافة شهادة جديدة</h4>

                <div class="ff-wrap">
                    <p class="ff-note">الحقول المعلمة بعلامة <span style="color:#e74c3c; font-weight:bold;">*</span>
                        إجبارية ولا يمكن الحفظ بدونها.</p>

                    {{ Form::open(['method' => 'POST', 'action' => ['App\Http\Controllers\Admin\CertificateController@store'], 'files' => true]) }}

                    {{-- الصورة --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-image"></i> صورة الشهادة</div>
                        <div class="ff-grid">
                            <div class="ff-field ff-field--full">
                                <label>الصورة <span class="req">*</span></label>
                                <input type="file" class="filestyle" data-placeholder="لم يتم اختيار ملف"
                                    data-iconname="fa fa-cloud-upload" name="image" required>
                                @if ($errors->has('image'))
                                    <span class="ff-error">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- بيانات الشهادة --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-info-circle"></i> بيانات الشهادة</div>
                        <div class="ff-grid">
                            <div class="ff-field">
                                <label>النص البديل للصورة (عربي) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="alt_ar" required
                                    value="{{ old('alt_ar') }}" placeholder="وصف قصير لصورة الشهادة (مهم للـ SEO)">
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
@section('scripts')
@endsection
