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
            <a style="color: #fff;" href="{{ route('admin.user.index') }}">/ المستخدمين / </a>
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
                <h4 class="header-title m-t-0 m-b-20" style="text-align:center;">إضافة مستخدم جديد</h4>

                <div class="ff-wrap">
                    <p class="ff-note">الحقول المعلمة بعلامة <span style="color:#e74c3c; font-weight:bold;">*</span>
                        إجبارية ولا يمكن الحفظ بدونها.</p>

                    {{ Form::open(['method' => 'POST', 'action' => ['App\Http\Controllers\Admin\UserController@store'], 'files' => true]) }}
                    @csrf

                    {{-- بيانات المستخدم --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-user"></i> بيانات المستخدم</div>
                        <div class="ff-grid">
                            <div class="ff-field">
                                <label>الاسم الأول <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="first_name" required
                                    value="{{ old('first_name') }}" placeholder="الاسم الأول للمستخدم">
                                @if ($errors->has('first_name'))
                                    <span class="ff-error">{{ $errors->first('first_name') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>الاسم الأخير <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="last_name" required
                                    value="{{ old('last_name') }}" placeholder="الاسم الأخير للمستخدم">
                                @if ($errors->has('last_name'))
                                    <span class="ff-error">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- بيانات التواصل --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-phone"></i> بيانات التواصل</div>
                        <div class="ff-grid">
                            <div class="ff-field">
                                <label>البريد الإلكتروني <span class="req">*</span></label>
                                <input type="email" class="ff-input" name="email" required dir="ltr"
                                    value="{{ old('email') }}" placeholder="example@email.com">
                                @if ($errors->has('email'))
                                    <span class="ff-error">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>الهاتف <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="phone" required dir="ltr"
                                    value="{{ old('phone') }}" placeholder="01xxxxxxxxx">
                                @if ($errors->has('phone'))
                                    <span class="ff-error">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>المدينة / المحافظة <span class="req">*</span></label>
                                <select name="city_id" class="form-control ff-input" required>
                                    <option value="">اختر المدينة</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('city_id'))
                                    <span class="ff-error">{{ $errors->first('city_id') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- كلمة المرور --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-lock"></i> كلمة المرور</div>
                        <div class="ff-grid">
                            <div class="ff-field">
                                <label>كلمة المرور <span class="req">*</span></label>
                                <input type="password" class="ff-input" name="password" required dir="ltr"
                                    placeholder="8 أحرف على الأقل">
                                @if ($errors->has('password'))
                                    <span class="ff-error">{{ $errors->first('password') }}</span>
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
<script>
    $('document').ready(function() {
        $('.discount').css('display', 'none');
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
