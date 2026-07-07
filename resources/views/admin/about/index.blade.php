@extends('layouts.admin')

@section('styles')
    @include('admin._form_styles')
@endsection

@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @elseif(Session::has('danger'))
                <div class="alert alert-danger">{{ Session::get('danger') }}</div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="main-title-00">

            <a style="color: #fff;" href="{{ route('admin.home') }}">الرئيسية</a>
            <a style="color: #36404a;"> / من نحن </a>

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
                <h4 class="header-title m-t-0 m-b-20" style="text-align:center;">من نحن</h4>

                <div class="ff-wrap">
                    @if (isset($about->id))
                        <p class="ff-note">جميع الحقول هنا اختيارية — عدّل ما تريد ثم اضغط حفظ.</p>

                        {{ Form::model($about, ['method' => 'PATCH', 'action' => ['App\Http\Controllers\Admin\AboutController@update', $about->id], 'files' => true]) }}

                        {{-- الوصف --}}
                        <div class="ff-card">
                            <div class="ff-card__head"><i class="fa fa-align-right"></i> الوصف</div>
                            <div class="ff-grid">
                                <div class="ff-field ff-field--full">
                                    <label>الوصف (عربي) <span class="opt">(اختياري)</span></label>
                                    <textarea class="ff-input" name="description_ar" id="content2" rows="4"
                                        placeholder="نبذة عن الشركة تظهر في صفحة من نحن">{{ old('description_ar', $about->description ?? '') }}</textarea>
                                    @if ($errors->has('description_ar'))
                                        <span class="ff-error">{{ $errors->first('description_ar') }}</span>
                                    @endif
                                </div>
                                <div class="ff-field ff-field--full">
                                    <label>الوصف (إنجليزي) <span class="opt">(اختياري)</span></label>
                                    <textarea class="ff-input" name="description_en" rows="4" dir="ltr"
                                        placeholder="About us description in English">{{ old('description_en', $about->description ?? '') }}</textarea>
                                    @if ($errors->has('description_en'))
                                        <span class="ff-error">{{ $errors->first('description_en') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- السياسات --}}
                        <div class="ff-card">
                            <div class="ff-card__head"><i class="fa fa-file-text-o"></i> السياسات</div>
                            <div class="ff-grid">
                                <div class="ff-field ff-field--full">
                                    <label>السياسات (عربي) <span class="opt">(اختياري)</span></label>
                                    <textarea class="ff-input" name="policy_ar" rows="4"
                                        placeholder="سياسات الموقع بالعربية">{{ old('policy_ar', $about->policy ?? '') }}</textarea>
                                    @if ($errors->has('policy_ar'))
                                        <span class="ff-error">{{ $errors->first('policy_ar') }}</span>
                                    @endif
                                </div>
                                <div class="ff-field ff-field--full">
                                    <label>السياسات (إنجليزي) <span class="opt">(اختياري)</span></label>
                                    <textarea class="ff-input" name="policy_en" rows="4" dir="ltr"
                                        placeholder="Website policies in English">{{ old('policy_en', $about->policy ?? '') }}</textarea>
                                    @if ($errors->has('policy_en'))
                                        <span class="ff-error">{{ $errors->first('policy_en') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="ff-actions">
                            <button type="submit" class="ff-submit">حفظ</button>
                        </div>

                        {!! Form::close() !!}
                    @else
                        <p class="ff-note">جميع الحقول هنا اختيارية — املأ ما تريد ثم اضغط حفظ.</p>

                        {{ Form::open(['method' => 'POST', 'action' => ['App\Http\Controllers\Admin\AboutController@store'], 'files' => true]) }}

                        {{-- الوصف والسياسات --}}
                        <div class="ff-card">
                            <div class="ff-card__head"><i class="fa fa-align-right"></i> الوصف والسياسات</div>
                            <div class="ff-grid">
                                <div class="ff-field ff-field--full">
                                    <label>الوصف <span class="opt">(اختياري)</span></label>
                                    <textarea class="ff-input" name="description" id="content2" rows="4"
                                        placeholder="نبذة عن الشركة تظهر في صفحة من نحن">{{ old('description') }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="ff-error">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                                <div class="ff-field ff-field--full">
                                    <label>السياسات <span class="opt">(اختياري)</span></label>
                                    <textarea class="ff-input" name="policy" rows="4"
                                        placeholder="سياسات الموقع">{{ old('policy') }}</textarea>
                                    @if ($errors->has('policy'))
                                        <span class="ff-error">{{ $errors->first('policy') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- الإحصائيات --}}
                        <div class="ff-card">
                            <div class="ff-card__head"><i class="fa fa-bar-chart"></i> الإحصائيات
                                <small>أرقام وإنجازات تظهر في صفحة من نحن</small>
                            </div>
                            <div class="ff-grid">
                                <div class="ff-field">
                                    <label>عنوان الإحصائية الأولى <span class="opt">(اختياري)</span></label>
                                    <input type="text" class="ff-input" name="title_one"
                                        value="{{ old('title_one') }}" placeholder="مثال: عدد العملاء">
                                    @if ($errors->has('title_one'))
                                        <span class="ff-error">{{ $errors->first('title_one') }}</span>
                                    @endif
                                </div>
                                <div class="ff-field">
                                    <label>قيمة الإحصائية الأولى <span class="opt">(اختياري)</span></label>
                                    <input type="text" class="ff-input" name="value_one" dir="ltr"
                                        value="{{ old('value_one') }}" placeholder="مثال: 500+">
                                    @if ($errors->has('value_one'))
                                        <span class="ff-error">{{ $errors->first('value_one') }}</span>
                                    @endif
                                </div>
                                <div class="ff-field">
                                    <label>عنوان الإحصائية الثانية <span class="opt">(اختياري)</span></label>
                                    <input type="text" class="ff-input" name="title_two"
                                        value="{{ old('title_two') }}">
                                    @if ($errors->has('title_two'))
                                        <span class="ff-error">{{ $errors->first('title_two') }}</span>
                                    @endif
                                </div>
                                <div class="ff-field">
                                    <label>قيمة الإحصائية الثانية <span class="opt">(اختياري)</span></label>
                                    <input type="text" class="ff-input" name="value_two" dir="ltr"
                                        value="{{ old('value_two') }}">
                                    @if ($errors->has('value_two'))
                                        <span class="ff-error">{{ $errors->first('value_two') }}</span>
                                    @endif
                                </div>
                                <div class="ff-field">
                                    <label>عنوان الإحصائية الثالثة <span class="opt">(اختياري)</span></label>
                                    <input type="text" class="ff-input" name="title_three"
                                        value="{{ old('title_three') }}">
                                    @if ($errors->has('title_three'))
                                        <span class="ff-error">{{ $errors->first('title_three') }}</span>
                                    @endif
                                </div>
                                <div class="ff-field">
                                    <label>قيمة الإحصائية الثالثة <span class="opt">(اختياري)</span></label>
                                    <input type="text" class="ff-input" name="value_three" dir="ltr"
                                        value="{{ old('value_three') }}">
                                    @if ($errors->has('value_three'))
                                        <span class="ff-error">{{ $errors->first('value_three') }}</span>
                                    @endif
                                </div>
                                <div class="ff-field">
                                    <label>عنوان الإحصائية الرابعة <span class="opt">(اختياري)</span></label>
                                    <input type="text" class="ff-input" name="title_four"
                                        value="{{ old('title_four') }}">
                                    @if ($errors->has('title_four'))
                                        <span class="ff-error">{{ $errors->first('title_four') }}</span>
                                    @endif
                                </div>
                                <div class="ff-field">
                                    <label>قيمة الإحصائية الرابعة <span class="opt">(اختياري)</span></label>
                                    <input type="text" class="ff-input" name="value_four" dir="ltr"
                                        value="{{ old('value_four') }}">
                                    @if ($errors->has('value_four'))
                                        <span class="ff-error">{{ $errors->first('value_four') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="ff-actions">
                            <button type="submit" class="ff-submit">حفظ</button>
                        </div>

                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </div><!-- end col -->
    </div>

@endsection
