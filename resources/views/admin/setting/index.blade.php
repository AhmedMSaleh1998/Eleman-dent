@extends('layouts.admin')

@section('styles')
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
            <a style="color: #36404a;"> / الإعدادات </a>

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
                <h4 class="header-title m-t-0 m-b-20" style="text-align:center;">إعدادات الموقع</h4>

                <div class="ff-wrap">
                    <p class="ff-note">الحقول المعلمة بعلامة <span style="color:#e74c3c; font-weight:bold;">*</span>
                        إجبارية ولا يمكن الحفظ بدونها.</p>

                    @if (!$setting)
                        {{ Form::model($setting, ['method' => 'Post', 'action' => ['App\Http\Controllers\Admin\SettingController@store'], 'files' => true]) }}
                    @else
                        {{ Form::model($setting, ['method' => 'PATCH', 'action' => ['App\Http\Controllers\Admin\SettingController@update', $setting->id], 'files' => true]) }}
                    @endif

                    {{-- بيانات التواصل --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-phone"></i> بيانات التواصل</div>
                        <div class="ff-grid">
                            <div class="ff-field">
                                <label>رقم الهاتف الأول <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="phone_one" dir="ltr"
                                    value="{{ old('phone_one', isset($setting) ? $setting->phone_one : null) }}"
                                    placeholder="مثال: +966500000000">
                                @if ($errors->has('phone_one'))
                                    <span class="ff-error">{{ $errors->first('phone_one') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>رقم الهاتف الثاني <span class="opt">(اختياري)</span></label>
                                <input type="text" class="ff-input" name="phone_two" dir="ltr"
                                    value="{{ old('phone_two', isset($setting) ? $setting->phone_two : null) }}"
                                    placeholder="مثال: +966500000000">
                                @if ($errors->has('phone_two'))
                                    <span class="ff-error">{{ $errors->first('phone_two') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>البريد الإلكتروني <span class="req">*</span></label>
                                <input type="email" class="ff-input" name="email" dir="ltr"
                                    value="{{ old('email', isset($setting) ? $setting->email : null) }}"
                                    placeholder="info@example.com">
                                @if ($errors->has('email'))
                                    <span class="ff-error">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="ff-field"></div>
                            <div class="ff-field">
                                <label>العنوان الأول (عربي) <span class="opt">(اختياري)</span></label>
                                <input type="text" class="ff-input" name="address_one_ar"
                                    value="{{ old('address_one_ar', isset($setting) ? $setting->translate('ar')->address_one : null) }}"
                                    placeholder="عنوان الفرع الأول كما يظهر في الموقع">
                                @if ($errors->has('address_one_ar'))
                                    <span class="ff-error">{{ $errors->first('address_one_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>العنوان الأول (إنجليزي) <span class="opt">(اختياري)</span></label>
                                <input type="text" class="ff-input" name="address_one_en" dir="ltr"
                                    value="{{ old('address_one_en', isset($setting) ? $setting->translate('en')->address_one : null) }}"
                                    placeholder="First branch address in English">
                                @if ($errors->has('address_one_en'))
                                    <span class="ff-error">{{ $errors->first('address_one_en') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>العنوان الثاني (عربي) <span class="opt">(اختياري)</span></label>
                                <input type="text" class="ff-input" name="address_two_ar"
                                    value="{{ old('address_two_ar', isset($setting) ? $setting->translate('ar')->address_two : null) }}"
                                    placeholder="عنوان الفرع الثاني كما يظهر في الموقع">
                                @if ($errors->has('address_two_ar'))
                                    <span class="ff-error">{{ $errors->first('address_two_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>العنوان الثاني (إنجليزي) <span class="opt">(اختياري)</span></label>
                                <input type="text" class="ff-input" name="address_two_en" dir="ltr"
                                    value="{{ old('address_two_en', isset($setting) ? $setting->translate('en')->address_two : null) }}"
                                    placeholder="Second branch address in English">
                                @if ($errors->has('address_two_en'))
                                    <span class="ff-error">{{ $errors->first('address_two_en') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- المواقع والخرائط --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-map-marker"></i> المواقع والخرائط</div>
                        <div class="ff-grid">
                            <div class="ff-field">
                                <label>رابط الموقع الأول <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="location_one" dir="ltr"
                                    value="{{ old('location_one', isset($setting) ? $setting->location_one : null) }}"
                                    placeholder="رابط موقع الفرع الأول على الخريطة">
                                @if ($errors->has('location_one'))
                                    <span class="ff-error">{{ $errors->first('location_one') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>رابط الموقع الثاني <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="location_two" dir="ltr"
                                    value="{{ old('location_two', isset($setting) ? $setting->location_two : null) }}"
                                    placeholder="رابط موقع الفرع الثاني على الخريطة">
                                @if ($errors->has('location_two'))
                                    <span class="ff-error">{{ $errors->first('location_two') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>رابط خريطة جوجل الأول (Src) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="src_one" dir="ltr"
                                    value="{{ old('src_one', isset($setting) ? $setting->src_one : null) }}"
                                    placeholder="رابط الـ src الخاص بخريطة جوجل للفرع الأول">
                                @if ($errors->has('src_one'))
                                    <span class="ff-error">{{ $errors->first('src_one') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>رابط خريطة جوجل الثاني (Src) <span class="req">*</span></label>
                                <input type="text" class="ff-input" name="src_two" dir="ltr"
                                    value="{{ old('src_two', isset($setting) ? $setting->src_two : null) }}"
                                    placeholder="رابط الـ src الخاص بخريطة جوجل للفرع الثاني">
                                @if ($errors->has('src_two'))
                                    <span class="ff-error">{{ $errors->first('src_two') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- السوشيال ميديا --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-share-alt"></i> السوشيال ميديا
                            <small>ضع الرابط الكامل لكل حساب</small>
                        </div>
                        <div class="ff-grid">
                            <div class="ff-field">
                                <label>فيسبوك <span class="opt">(اختياري)</span></label>
                                <input type="text" class="ff-input" name="facebook" dir="ltr"
                                    value="{{ old('facebook', isset($setting) ? $setting->facebook : null) }}"
                                    placeholder="https://facebook.com/...">
                                @if ($errors->has('facebook'))
                                    <span class="ff-error">{{ $errors->first('facebook') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>لينكد إن <span class="opt">(اختياري)</span></label>
                                <input type="text" class="ff-input" name="twitter" dir="ltr"
                                    value="{{ old('twitter', isset($setting) ? $setting->twitter : null) }}"
                                    placeholder="https://linkedin.com/...">
                                @if ($errors->has('twitter'))
                                    <span class="ff-error">{{ $errors->first('twitter') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>إنستجرام <span class="opt">(اختياري)</span></label>
                                <input type="text" class="ff-input" name="instagram" dir="ltr"
                                    value="{{ old('instagram', isset($setting) ? $setting->instagram : null) }}"
                                    placeholder="https://instagram.com/...">
                                @if ($errors->has('instagram'))
                                    <span class="ff-error">{{ $errors->first('instagram') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>واتساب <span class="opt">(اختياري)</span></label>
                                <input type="text" class="ff-input" name="whatsapp" dir="ltr"
                                    value="{{ old('whatsapp', isset($setting) ? $setting->whatsapp : null) }}"
                                    placeholder="رقم الواتساب أو الرابط">
                                @if ($errors->has('whatsapp'))
                                    <span class="ff-error">{{ $errors->first('whatsapp') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>يوتيوب <span class="opt">(اختياري)</span></label>
                                <input type="text" class="ff-input" name="youtube" dir="ltr"
                                    value="{{ old('youtube', isset($setting) ? $setting->youtube : null) }}"
                                    placeholder="https://youtube.com/...">
                                @if ($errors->has('youtube'))
                                    <span class="ff-error">{{ $errors->first('youtube') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- تحسين محركات البحث --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-search"></i> تحسين محركات البحث (SEO)
                            <small>هذه الحقول تظهر في نتائج بحث جوجل</small>
                        </div>
                        <div class="ff-grid">
                            <div class="ff-field">
                                <label>الكلمات المفتاحية (عربي) <span class="opt">(اختياري)</span></label>
                                <input type="text" class="ff-input" name="keywords_ar"
                                    value="{{ old('keywords_ar', isset($setting) ? $setting->translate('ar')->keywords : null) }}"
                                    placeholder="كلمات مفصولة بفواصل">
                                @if ($errors->has('keywords_ar'))
                                    <span class="ff-error">{{ $errors->first('keywords_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field">
                                <label>الكلمات المفتاحية (إنجليزي) <span class="opt">(اختياري)</span></label>
                                <input type="text" class="ff-input" name="keywords_en" dir="ltr"
                                    value="{{ old('keywords_en', isset($setting) ? $setting->translate('en')->keywords : null) }}"
                                    placeholder="Comma separated keywords">
                                @if ($errors->has('keywords_en'))
                                    <span class="ff-error">{{ $errors->first('keywords_en') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- نصوص الموقع --}}
                    <div class="ff-card">
                        <div class="ff-card__head"><i class="fa fa-align-right"></i> نصوص الموقع</div>
                        <div class="ff-grid">
                            <div class="ff-field ff-field--full">
                                <label>من نحن (عربي) <span class="opt">(اختياري)</span></label>
                                <textarea id="textarea" maxlength="1000" rows="3" class="ff-input" name="about_us_ar"
                                    placeholder="نبذة عن الشركة تظهر في صفحة من نحن">{{ old('about_us_ar', $setting ? $setting->translate('ar')->about_us : null) }}</textarea>
                                @if ($errors->has('about_us_ar'))
                                    <span class="ff-error">{{ $errors->first('about_us_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field ff-field--full">
                                <label>من نحن (إنجليزي) <span class="opt">(اختياري)</span></label>
                                <textarea id="textarea" maxlength="1000" rows="3" class="ff-input" name="about_us_en" dir="ltr"
                                    placeholder="About us text in English">{{ old('about_us_en', $setting ? $setting->translate('en')->about_us : null) }}</textarea>
                                @if ($errors->has('about_us'))
                                    <span class="ff-error">{{ $errors->first('about_us') }}</span>
                                @endif
                            </div>
                            <div class="ff-field ff-field--full">
                                <label>سياسة الخصوصية (عربي) <span class="opt">(اختياري)</span></label>
                                <textarea id="textarea" maxlength="100" rows="3" class="ff-input" name="privacy_ar"
                                    placeholder="نص سياسة الخصوصية بالعربية">{{ old('privacy_ar', $setting ? $setting->translate('ar')->privacy : null) }}</textarea>
                                @if ($errors->has('privacy_ar'))
                                    <span class="ff-error">{{ $errors->first('privacy_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field ff-field--full">
                                <label>سياسة الخصوصية (إنجليزي) <span class="opt">(اختياري)</span></label>
                                <textarea id="textarea" maxlength="100" rows="3" class="ff-input" name="privacy_en" dir="ltr"
                                    placeholder="Privacy policy text in English">{{ old('privacy_en', $setting ? $setting->translate('en')->privacy : null) }}</textarea>
                                @if ($errors->has('privacy_en'))
                                    <span class="ff-error">{{ $errors->first('privacy_en') }}</span>
                                @endif
                            </div>
                            <div class="ff-field ff-field--full">
                                <label>الشروط والأحكام (عربي) <span class="req">*</span></label>
                                <textarea id="textarea" maxlength="100" rows="3" class="ff-input" name="terms_ar"
                                    placeholder="نص الشروط والأحكام بالعربية">{{ old('terms_ar', $setting ? $setting->translate('ar')->terms : null) }}</textarea>
                                @if ($errors->has('terms_ar'))
                                    <span class="ff-error">{{ $errors->first('terms_ar') }}</span>
                                @endif
                            </div>
                            <div class="ff-field ff-field--full">
                                <label>الشروط والأحكام (إنجليزي) <span class="req">*</span></label>
                                <textarea id="textarea" maxlength="100" rows="3" class="ff-input" name="terms_en" dir="ltr"
                                    placeholder="Terms and conditions text in English">{{ old('terms_en', $setting ? $setting->translate('en')->terms : null) }}</textarea>
                                @if ($errors->has('terms_en'))
                                    <span class="ff-error">{{ $errors->first('terms_en') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if ($setting)
                        {{-- اللوجو والبانر --}}
                        <div class="ff-card">
                            <div class="ff-card__head"><i class="fa fa-image"></i> اللوجو والبانر</div>
                            <div class="ff-grid">
                                <div class="ff-field">
                                    <label>البانر الرئيسي <span class="opt">(اختياري)</span></label>
                                    <input type="file" class="filestyle" data-placeholder="لم يتم اختيار ملف"
                                        data-iconname="fa fa-cloud-upload" name="main_banner">
                                    @if ($setting->main_banner)
                                        <img class="ff-current-img"
                                            src="{{ asset('admin_assets/images/settings/' . $setting->main_banner) }}"
                                            onerror="this.style.display='none'">
                                    @endif
                                    @if ($errors->has('main_banner'))
                                        <span class="ff-error">{{ $errors->first('main_banner') }}</span>
                                    @endif
                                </div>
                                <div class="ff-field">
                                    <label>اللوجو <span class="opt">(اختياري)</span></label>
                                    <input type="file" class="filestyle" data-placeholder="لم يتم اختيار ملف"
                                        data-iconname="fa fa-cloud-upload" name="logo">
                                    @if ($setting->logo)
                                        <img class="ff-current-img"
                                            src="{{ asset('admin_assets/images/settings/' . $setting->logo) }}"
                                            onerror="this.style.display='none'">
                                    @endif
                                    @if ($errors->has('logo'))
                                        <span class="ff-error">{{ $errors->first('logo') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="ff-actions">
                        <button type="submit" class="ff-submit">حفظ</button>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div><!-- end col -->
    </div>
@endsection
