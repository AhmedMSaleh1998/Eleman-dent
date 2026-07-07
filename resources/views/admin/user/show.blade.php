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
            <a style="color: #fff;" href="{{route('admin.home')}}">الرئيسية</a>
            <a style="color: #fff;" href="{{route('admin.user.index')}}">/ المستخدمين / </a>
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
                <h4 class="header-title m-t-0 m-b-20" style="text-align:center;">بيانات المستخدم</h4>

                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td>الصورة الشخصية</td>
                            <td>
                            {!! $user->image ? '<img src="' . asset('admin_assets/images/users/' . $user->image) . '" class="img-responsive" width="100px" height="100px">' : 'لا توجد صورة' !!}
                        </td>
                        </tr>
                        <tr>
                            <td>الاسم الأول</td>
                            <td>{{ $user->first_name }}</td>
                        </tr>
                        <tr>
                            <td>الاسم الأخير</td>
                            <td>{{ $user->last_name }}</td>
                        </tr>
                        <tr>
                            <td>الهاتف</td>
                            <td>{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <td>المدينة</td>
                            <td>{{ $user->city->name }}</td>
                        </tr>
                        <tr>
                            <td>الحالة</td>
                            <td>{{ $user->status == 1 ? 'فعال' : 'غير فعال' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div><!-- end col -->
    </div>

@endsection
