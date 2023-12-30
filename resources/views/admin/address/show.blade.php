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
        <a style="color: #fff;" href="{{route('admin.address.index' , $address->user_id)}}">/ العناوين / </a>
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

            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <td>المنطقة</td>
                        <td>{{ $address->district->name_ar }}</td>
                    </tr>
                    <tr>
                        <td>اسم الشارع</td>
                        <td>{{ $address->street }}</td>
                    </tr>
                    <tr>
                        <td>رقم الميني</td>
                        <td>{{ $address->building }}</td>
                    </tr>
                    <tr>
                        <td>رقم الدور</td>
                        <td>{{ $address->floor }}</td>
                    </tr>
                    <tr>
                        <td>رقم الشقة</td>
                        <td>{{ $address->apartment }}</td>
                    </tr>
                    <tr>
                        <td>الهاتف</td>
                        <td>{{ $address->phone }}</td>
                    </tr>
                    <tr>
                        <td>الحالة</td>
                        <td>{{$address->status == 1 ? 'مفعل' : 'لم يفعل'}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div><!-- end col -->
</div>

@endsection