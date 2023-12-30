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
        <a style="color: #fff;" href="{{ route('admin.product.index') }}">/ المنتجات / </a>
        <a style="color: #36404a;"> إضافة </a>

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
            <h4 class="header-title m-t-0 m-b-20">اضافه منتج جديد</h4>
            {{ Form::open(['method' => 'POST', 'action' => ['App\Http\Controllers\Admin\ProductController@store'], 'files' => true]) }}
            @csrf
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <td>الصورة</td>
                        <td>
                            <input type="file" class="filestyle" data-placeholder="No file" data-iconname="fa fa-cloud-upload" name="image" required>
                            @if ($errors->has('image'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                            @endif

                        </td>
                    </tr>
                    <tr>
                        <td> اسم المنتج عربي</td>
                        <td><input type="text" class="form-control" name="name_ar" required value="{{ old('name_ar') }}"></td>
                        @if ($errors->has('name_ar'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('name_ar') }}</strong>
                        </span>
                        @endif
                    </tr>
                    <tr>
                        <td> اسم المنتج إنجليزي</td>
                        <td><input type="text" class="form-control" name="name_en" required value="{{ old('name_en') }}"></td>
                        @if ($errors->has('name_en'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('name_en') }}</strong>
                        </span>
                        @endif
                    </tr>
                    <tr>
                        <td>sku</td>
                        <td><input type="text" class="form-control" name="sku" required value="{{ old('sku') }}"></td>
                        @if ($errors->has('sku'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('sku') }}</strong>
                        </span>
                        @endif
                    </tr>
                    <tr>
                        <td>الوصف عربي</td>
                        <td>
                            <textarea id="textarea" maxlength="100" class="form-control" name="description_ar"></textarea>
                        </td>
                        @if ($errors->has('description_ar'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('description_ar') }}</strong>
                        </span>
                        @endif
                    </tr>
                    <tr>
                        <td>الوصف إنجليزي</td>
                        <td>
                            <textarea id="textarea" maxlength="100" class="form-control" name="description_en"></textarea>
                        </td>
                        @if ($errors->has('description_en'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('description_en') }}</strong>
                        </span>
                        @endif
                    </tr>
                    <td>اختر القسم</td>
                    <td>
                        {!! Form::select('category_id', $data['categories']->pluck('name_ar' , 'id'), $record->categories??null, ['class' => 'form-control']) !!}
                    </td>
                    @if ($errors->has('category_id'))
                    <span class="alert alert-danger">
                        <strong>{{ $errors->first('category_id') }}</strong>
                    </span>
                    @endif
                    </tr>
                    
                    <tr>
                        <td>اختر اللون</td>
                        <td>
                            {!! Form::select('color_id[]', $data['colors']->pluck('name_ar' , 'id'), $record->colors??null, ['class' => 'form-control','multiple' => 'multiple']) !!}
                        </td>
                        @if ($errors->has('color_id'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('color_id') }}</strong>
                        </span>
                        @endif
                    </tr>

                    <tr>
                        <td>اختر النوع</td>
                        <td>
                            {!! Form::select('type_id[]', $data['types']->pluck('name_ar' , 'id'), $record->types??null, ['class' => 'form-control ','multiple' => 'multiple']) !!}
                        </td>
                        @if ($errors->has('type_id'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('type_id') }}</strong>
                        </span>
                        @endif
                    </tr>

                    <tr>
                        <td>اختر المنتجات المتعلقة</td>
                        <td>
                            {!! Form::select('related_id[]', $data['related']->pluck('name_ar' , 'id'), $record->products??null, ['class' => 'form-control ','multiple' => 'multiple']) !!}
                        </td>
                        @if ($errors->has('related_id'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('related_id') }}</strong>
                        </span>
                        @endif
                    </tr>
                    <tr>
                        <td style="width:25%"></td>
                        <td><button type="submit" class="btn btn-default waves-effect waves-light form-control">حفظ</button></td>
                    </tr>
                </tbody>
            </table>
            {!! Form::close() !!}

        </div>
    </div><!-- end col -->
</div>
@endsection
@section('scripts')
<script>
    $('document').ready(function() {
        $('.discount').css('display', 'none');
        $(".isDiscount").change(function() {
            if (this.checked) {
                $('.discount').css('display', 'table-row');
            } else {
                $('.discount').css('display', 'none');
            }
        });
    });
</script>
@endsection