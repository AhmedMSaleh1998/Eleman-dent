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
            <a style="color: #36404a;"> مشاهدة </a>

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
                <h4 class="header-title m-t-0 m-b-20">{{$user->name_ar}}</h4>

                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td>الصورة الرئيسية</td>
                            <td>
                            {!! $user->image ? '<img src="' . asset('admin_assets/images/users/' . $user->image) . '" class="img-responsive" width="100px" height="100px">' : 'No Image' !!}
                        </td>
                        </tr>
                        <tr>
                            <td>الاسم الاول</td>
                            <td>{{ $user->first_name }}</td>
                        </tr>
                        <tr>
                            <td>الاسم الاخير</td>
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
                            <td>{{$user->status == 1 ? 'مفعل' : 'لم يفعل'}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div><!-- end col -->
    </div>

@endsection
