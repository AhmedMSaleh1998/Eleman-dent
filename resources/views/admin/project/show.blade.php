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
            <a style="color: #fff;" href="{{route('admin.projects.index')}}">/ المشاريع / </a>
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
                <h4 class="header-title m-t-0 m-b-20">{{$project->name_ar}}</h4>

                <table class="table table-bordered table-striped">
                    <tbody>

                        <tr>
                            <td>الصورة الرئيسية</td>
                            <td><img src="{{asset('admin_assets/images/projects/'.$project->image)}}" class="img-responsive" width="100px" height="100px"></td>
                        </tr>
                        <tr>
                            <td>الاسم انجليزى</td>
                            <td>{{ $project->name_en }}</td>
                        </tr>
                        <tr>
                            <td>الاسم عربي</td>
                            <td>{{ $project->name_ar }}</td>
                        </tr>
                        <tr>
                            <td>الوصف انجليزى</td>
                            <td>{{ $project->description_en }}</td>
                        </tr>
                        <tr>
                            <td>الوصف عربي</td>
                            <td>{{ $project->description_ar }}</td>
                        </tr>
                        <tr>
                            <td>المحتوى انجليزى</td>
                            <td>{{ $project->content_en }}</td>
                        </tr>
                        <tr>
                            <td>المحتوى عربي</td>
                            <td>{{ $project->content_ar }}</td>
                        </tr>
                        <tr>
                            <td>الحالة</td>
                            <td>{{$project->status == 1 ? 'مفعل' : 'لم يفعل'}}</td>
                        </tr>
                        <tr>
                            <td>اظهار فى الصفحة الرئيسية</td>
                            <td>{{$project->home == 1 ? 'اظهار' : 'لم تظهر'}}</td>
                        </tr>
                        <tr>
                            <td>صور المشروع</td>
                            @foreach ($project->projectImages as $image)
                            <td><img src="{{ asset('admin_assets/images/projects/'.$image->image) }}" class="img-responsive" width="100px" height="100px"></td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div><!-- end col -->
    </div>

@endsection
