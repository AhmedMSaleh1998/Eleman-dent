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
            <h4 class="header-title m-t-0 m-b-20">تعديل منتج</h4>
            {{ Form::model($product, ['method' => 'PATCH', 'action' => ['App\Http\Controllers\Admin\ProductController@update', $product->id], 'files' => true]) }}
            @csrf
            @method('PUT')
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <td>الصورة</td>
                        <td>
                            <input type="file" class="filestyle" data-placeholder="No file" data-iconname="fa fa-cloud-upload" name="image" value="{{ old('image') ? old('image') : $product->image }}">
                            <img src="{{ asset('admin_assets/images/products/' . $product->image) }}" class="img-responsive" width="100px" height="100px">
                            @if ($errors->has('image'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                            @endif

                        </td>
                    </tr>
                    <tr>
                        <td>الاسم عربي</td>
                        <td><input type="text" class="form-control" name="name_ar" required value="{{ old('name_ar') ? old('name_ar') : $product->name_ar }}"></td>
                        @if ($errors->has('name_ar'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('name_ar') }}</strong>
                        </span>
                        @endif
                    </tr>
                    <tr>
                        <td>الاسم انجليزي</td>
                        <td><input type="text" class="form-control" name="name_en" required value="{{ old('name_en') ? old('name_en') : $product->name_en }}"></td>
                        @if ($errors->has('name_en'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('name_en') }}</strong>
                        </span>
                        @endif
                    </tr>
                    <tr class="discount" style="display:{{$product->is_discount ? 'table-row' : 'none'}}">
                        <td>السعر بعد الخصم</td>
                        <td><input type="text" class="form-control" name="discount_price" value="{{ old('discount_price') ? old('discount_price') : $product->discount_price }}"></td> @if ($errors->has('description_en'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('discount_price') }}</strong>
                        </span>
                        @endif
                    </tr>
                    <tr>
                        <td>الوصف عربي</td>
                        <td>
                            <textarea id="textarea" maxlength="100" class="form-control" name="description_ar">{{ old('description_ar') ? old('description_ar') : $product->description_ar }}</textarea>
                        </td>
                        @if ($errors->has('description_ar'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('description_ar') }}</strong>
                        </span>
                        @endif
                    </tr>
                    <tr>
                        <td>الوصف انجليزي</td>
                        <td>
                            <textarea id="textarea" maxlength="100" class="form-control" name="description_en">{{ old('description_en') ? old('description_en') : $product->description_en }}</textarea>
                        </td>
                        @if ($errors->has('description_en'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('description_en') }}</strong>
                        </span>
                        @endif
                    </tr>
                    <tr>
                        <td>SKU</td>
                        <td>
                            <textarea id="textarea" maxlength="100" class="form-control" name="sku">{{ old('sku') ? old('sku') : $product->sku }}</textarea>
                        </td>
                        @if ($errors->has('sku'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('sku') }}</strong>
                        </span>
                        @endif
                    </tr>
                    <tr>
                        <td>القسم</td>
                        <td>
                            {!! Form::select('category_id', $data['categories']->pluck('name_ar', 'id'), $products->category_id??null, ['class' => 'form-control']) !!}
                        </td>
                        @if ($errors->has('category_id'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('category_id') }}</strong>
                        </span>
                        @endif
                    </tr>
                    
                    <tr>
                        <td>اللون </td>
                        <td>
                            {{-- {!! Form::select('color_id[]', $data['colors']->pluck('name_ar', 'id'), $product->colors??null, ['class' => 'form-control' , 'multiple => multiple']) !!} --}}
                           <select name="color_id[]" class="form-control" multiple>
                            @foreach ($data['colors'] as $color)
                            <option value="{{ $color->id}}"  {{ in_array($color->id, $product->colors->pluck('id')->toArray()) ? 'selected' : '' }}>{{$color->name_ar}}</option>
                            @endforeach
                           </select>
                        </td>
                        @if ($errors->has('color_id'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('color_id') }}</strong>
                        </span>
                        @endif
                    </tr>

                    <tr>
                        <td>النوع </td>
                        <td>
                            {{-- {!! Form::select('color_id[]', $data['colors']->pluck('name_ar', 'id'), $product->colors??null, ['class' => 'form-control' , 'multiple => multiple']) !!} --}}
                           <select name="type_id[]" class="form-control" multiple>
                            @foreach ($data['types'] as $type)
                            <option value="{{ $type->id}}"  {{ in_array($type->id, $product->types->pluck('id')->toArray()) ? 'selected' : '' }}>{{$type->name_ar}}</option>
                            @endforeach
                           </select>
                        </td>
                        @if ($errors->has('color_id'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('color_id') }}</strong>
                        </span>
                        @endif
                    </tr>

                    <tr>
                        <td>المنتجات المتعلقة </td>
                        <td>
                            {{-- {!! Form::select('color_id[]', $data['colors']->pluck('name_ar', 'id'), $product->colors??null, ['class' => 'form-control' , 'multiple => multiple']) !!} --}}
                           <select name="related_id[]" class="form-control" multiple>
                            @foreach ( $data['related']->whereNotIn('id' , [$product->id]) as $related)
                            <option value="{{ $related->id }}"  {{ in_array($related->id, $product->related->pluck('id')->toArray()) ? 'selected' : '' }}>{{$related->name_ar}}</option>
                            @endforeach
                           </select>
                        </td>
                        @if ($errors->has('related_id'))
                        <span class="alert alert-danger">
                            <strong>{{ $errors->first('related_id') }}</strong>
                        </span>
                        @endif
                    </tr>
                    <tr>
                        <td style="width:25%"></td>
                        <td><button type="submit" class="btn btn-default waves-effect waves-light form-control">تعديل</button></td>
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