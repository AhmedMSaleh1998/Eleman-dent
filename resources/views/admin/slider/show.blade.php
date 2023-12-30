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
            <a style="color: #fff;" href="{{route('admin.category.index')}}">/ الاقسام / </a>
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
                <h4 class="header-title m-t-0 m-b-20">{{$category->title_ar}}</h4>

                <table class="table table-bordered table-striped">
                    <tbody>
                
                        <tr>
                            <td>الصورة</td>
                            <td><img src="{{asset('admin_assets/images/category/'.$category->image)}}" class="img-responsive" width="100px" height="100px"></td>
                        </tr>
                        <tr>
                            <td>الاسم انجليزى</td>
                            <td>{{ $category->title_en }}</td>
                        </tr>
                        <tr>
                            <td>الاسم عربي</td>
                            <td>{{ $category->title_ar }}</td>
                        </tr>
                        <tr>
                            <td>الوصف انجليزى</td>
                            <td>{{ $category->description_en }}</td>
                        </tr>
                        <tr>
                            <td>الوصف عربي</td>
                            <td>{{ $category->description_ar }}</td>
                        </tr>
                    </tbody>
                </table>
                
            </div>
        </div><!-- end col -->
    </div>
        
@endsection