@extends('layouts.admin')

@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="main-title-00">
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @elseif(Session::has('danger'))
                <div class="alert alert-danger">{{ Session::get('danger') }}</div>
            @endif
            <a style="color: #fff;" href="{{ route('admin.home') }}">الرئيسية</a>
            <a style="color: #fff;" href="{{ route('admin.event.index') }}">/ الأحداث / </a>
            <a style="color: #36404a;"> عرض </a>

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
                <h4 class="header-title m-t-0 m-b-20">{{ $event->name_ar }}</h4>

                <table class="table table-bordered table-striped">
                    <tbody>

                        <tr>
                            <td>الصورة الرئيسية</td>
                            <td><img src="{{ asset('admin_assets/images/events/' . $event->image) }}" class="img-responsive"
                                    width="100px" height="100px"></td>
                        </tr>
                        <tr>
                            <td>الاسم (عربي)</td>
                            <td>{{ $event->translate('ar')->name }}</td>
                        </tr>
                        <tr>
                            <td>الاسم (إنجليزي)</td>
                            <td>{{ $event->translate('en')->name }}</td>
                        </tr>

                        <tr>
                            <td>الوصف (عربي)</td>
                            <td>{{ $event->translate('ar')->description }}</td>
                        </tr>
                        <tr>
                            <td>الوصف (إنجليزي)</td>
                            <td>{{ $event->translate('en')->description }}</td>
                        </tr>

                        <tr>
                            <td>المكان (عربي)</td>
                            <td>{{ $event->translate('ar')->location }}</td>
                        </tr>
                        <tr>
                            <td>المكان (إنجليزي)</td>
                            <td>{{ $event->translate('en')->location }}</td>

                        <tr>

                        <tr>
                            <td>التاريخ</td>
                            <td>{{ $event->date }}</td>

                        <tr>
                            <td>الحالة</td>
                            <td>{{ $event->status == 1 ? 'ظاهر' : 'مخفي' }}</td>
                        </tr>



                    </tbody>
                </table>
            </div>
        </div><!-- end col -->
    </div>
@endsection
