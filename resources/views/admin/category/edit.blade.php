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
@endsection

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
        <a style="color: #fff;" href="{{ route('admin.category.index') }}">/ قسم  / </a>
        <a style="color: #36404a;"> تعديل </a>

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
            <h4 class="header-title m-t-0 m-b-20">تعديل قسم </h4>

            <table class="table table-bordered table-striped">
                {{ Form::model($category, ['method' => 'PATCH', 'action' => ['App\Http\Controllers\Admin\CategoryController@update', $category->id], 'files' => true]) }}
                <tbody>
                    <tr>
                        <td>الصورة</td>
                        <td>
                            <input type="file" class="filestyle" data-placeholder="No file" data-iconname="fa fa-cloud-upload" name="image">
                            <img src="{{ asset('admin_assets/images/categories/' . $category->image) }}" class="img-responsive" width="100px" height="100px">
                            @if ($errors->has('image'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                            @endif

                        </td>
                    </tr>

                    <tr>
                        <td>اسم عربي </td>
                        <td><input type="text" class="form-control" name="name_ar" required value="{{ $category->name_ar }}"></td>
                        @if ($errors->has('name_ar'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('name_ar') }}</strong>
                        </span>
                        @endif
                    </tr>

                    <tr>
                        <td>اسم انجليزي </td>
                        <td><input type="text" class="form-control" name="name_en" required value="{{ $category->name_en }}"></td>
                        @if ($errors->has('name_en'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('name_en') }}</strong>
                        </span>
                        @endif
                    </tr>

                    <tr>
                        <td>الترتيب </td>
                        <td><input type="text" class="form-control" name="order" required value="{{ $category->order }}"></td>
                        @if ($errors->has('order'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('order') }}</strong>
                        </span>
                        @endif
                    </tr>
                    <tr>
                        <td style="width:25%"></td>
                        <td><button type="submit" class="btn btn-default waves-effect waves-light form-control">تعديل</button></td>
                    </tr>
                </tbody>
                {!! Form::close() !!}
            </table>
        </div>
    </div><!-- end col -->
</div>
@endsection
