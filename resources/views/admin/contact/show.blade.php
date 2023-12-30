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
        <a style="color: #fff;" href="{{route('admin.contact.index')}}">/ طلبات التواصل / </a>
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
            <h4 class="header-title m-t-0 m-b-20">مشاهدة طلب تواصل</h4>

            <table class="table table-bordered table-striped">
                <tbody>

                    <tr>
                        <td>الاسم</td>
                        <td>{{$contact->name}}</td>
                    </tr>

                    <tr>
                        <td> ألموضوع</td>
                        <td>{{$contact->subject}}</td>
                    </tr>

                    <tr>
                        <td>البريد الالكترونى</td>
                        <td>{{$contact->email}}</td>
                    </tr>

                    <tr>
                        <td>رقم الجوال</td>
                        <td>{{$contact->phone}}</td>
                    </tr>

                    <tr>
                        <td>الرسالة</td>
                        <td>{{$contact->message}}</td>
                    </tr>

                    <tr>
                        <td>تاريخ الطلب</td>
                        <td>{{$contact->created_at}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div><!-- end col -->
</div>

@endsection
