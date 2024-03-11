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
@if (Session::has('success'))
<div class="alert alert-success text-center">{{ Session::get('success') }}</div>
@elseif(Session::has('danger'))
<div class="alert alert-danger text-center">{{ Session::get('danger') }}</div>
@endif
<div class="row">
    <div class="main-title-00">
      
        <a style="color: #fff;" href="{{ route('admin.home') }}">Home</a>
        <a style="color: #fff;" href="{{ route('admin.productimage.index',$product_id) }}">/ Product Images/ </a>
        <a style="color: #36404a;"> Add </a>

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
            <h4 class="header-title m-t-0 m-b-20"> Add Product Image</h4>
            {{ Form::open(['method'=>'POST','action' => ['App\Http\Controllers\Admin\ProductImageController@store'], 'files' => true])}}

            @csrf
            <table class="table table-bordered table-striped">
                <tbody>
                    <input type="hidden" name="product_id" value="{{ $product_id }}">
                    <tr>
                        <td>Image</td>
                        <td>
                            <input type="file" class="filestyle" data-placeholder="No file" data-iconname="fa fa-cloud-upload" name="image" required>
                            @if ($errors->has('image'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                            @endif

                        </td>

                        <tr>
                            <td>Alt </td>
                            <td><input type="text" class="form-control" name="alt" ></td>
                            @if ($errors->has('alt'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('alt') }}</strong>
                            </span>
                            @endif
                        </tr>
                    </tr>
                    <tr>
                        <td style="width:25%"></td>
                        <td><button type="submit" class="btn btn-default waves-effect waves-light form-control">save</button></td>
                    </tr>
                </tbody>
            </table>
            {!! Form::close() !!}

        </div>
    </div><!-- end col -->
</div>
@endsection
