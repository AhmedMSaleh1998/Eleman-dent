@extends('layouts.admin')

@section('styles')
    <!-- Plugins css-->
    <link href="{{ asset('admin_assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_assets/plugins/switchery/css/switchery.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_assets/plugins/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_assets/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('admin_assets/plugins/bootstrap-table/css/bootstrap-table.min.css') }}" rel="stylesheet"
        type="text/css" />
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
            <a style="color: #fff;" href="{{ route('admin.product.index') }}">/ Product / </a>
            <a style="color: #36404a;"> Edit </a>

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
                <h4 class="header-title m-t-0 m-b-20"> Edit Product</h4>
                {{ Form::model($product, ['method' => 'PATCH', 'action' => ['App\Http\Controllers\Admin\ProductController@update', $product->id], 'files' => true]) }}
                @csrf
                @method('PUT')
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td>Image</td>
                            <td>
                                <input type="file" class="filestyle" data-placeholder="No file"
                                    data-iconname="fa fa-cloud-upload" name="image"
                                    value="{{ old('image') ? old('image') : $product->image }}">
                                <img src="{{ asset('admin_assets/images/products/' . $product->image) }}"
                                    class="img-responsive" width="100px" height="100px">
                                @if ($errors->has('image'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif

                            </td>
                        </tr>
                        <tr>
                            <td>Name Ar </td>
                            <td><input type="text" class="form-control" name="name_ar" required
                                    value="{{ old('name_ar') ? old('name_ar') : $product->translate('ar')->name }}"></td>
                            @if ($errors->has('name_ar'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('name_ar') }}</strong>
                                </span>
                            @endif
                        </tr>
                        <tr>
                            <td>Name En </td>
                            <td><input type="text" class="form-control" name="name_en" required
                                    value="{{ old('name_en') ? old('name_en') : $product->translate('en')->name }}"></td>
                            @if ($errors->has('name_en'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('name_en') }}</strong>
                                </span>
                            @endif
                        </tr>
                        <tr>
                            <td>Price </td>
                            <td><input type="number" class="form-control" name="price"
                                    value="{{ old('price') ? old('price') : $product->price }}"></td>
                            @if ($errors->has('price'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </span>
                            @endif
                        </tr>
                        <tr>
                            <td>Quantity </td>
                            <td><input type="number" class="form-control" name="quantity"
                                    value="{{ old('quantity') ? old('quantity') : $product->quantity }}"></td>
                            @if ($errors->has('quantity'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('quantity') }}</strong>
                                </span>
                            @endif
                        </tr>

                        <tr>
                            <td>Title Arabic </td>
                            <td><input type="text" class="form-control" name="title_ar" required
                                    value="{{ $product->translate('ar')->title }}"></td>
                            @if ($errors->has('title_ar'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('title_ar') }}</strong>
                                </span>
                            @endif
                        </tr>

                        <tr>
                            <td>Title English </td>
                            <td><input type="text" class="form-control" name="title_en" required
                                    value="{{ $product->translate('en')->title }}"></td>
                            @if ($errors->has('title_en'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('title_en') }}</strong>
                                </span>
                            @endif
                        </tr>

                        <tr>
                            <td> Alt Arabic </td>
                            <td><input type="text" class="form-control" name="alt_ar" required
                                    value="{{ $product->translate('ar')->alt }}"></td>
                            @if ($errors->has('alt_ar'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('alt_ar') }}</strong>
                                </span>
                            @endif
                        </tr>

                        <tr>
                            <td> Alt English </td>
                            <td><input type="text" class="form-control" name="alt_en" required
                                    value="{{ $product->translate('en')->alt }}"></td>
                            @if ($errors->has('alt_en'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('alt_en') }}</strong>
                                </span>
                            @endif
                        </tr>
                        <tr>
                            <td>Description Ar </td>
                            <td>
                                <textarea id="textarea" maxlength="100" class="form-control" name="description_ar">{{ old('description_ar') ? old('description_ar') : $product->translate('ar')->description }}</textarea>
                            </td>
                            @if ($errors->has('description_ar'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('description_ar') }}</strong>
                                </span>
                            @endif
                        </tr>

                        <tr>
                            <td> Description En</td>
                            <td>
                                <textarea id="textarea" maxlength="100" class="form-control" name="description_en">{{ old('description_en') ? old('description_en') : $product->translate('en')->description }}</textarea>
                            </td>
                            @if ($errors->has('description_en'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('description_en') }}</strong>
                                </span>
                            @endif
                        </tr>
                        <tr>
                            <td> Description Meta Arabic </td>
                            <td><input type="text" class="form-control" name="description_meta_ar" required
                                    value="{{ $product->translate('ar')->description_meta }}"></td>
                            @if ($errors->has('description_meta_ar'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('description_meta_ar') }}</strong>
                                </span>
                            @endif
                        </tr>

                        <tr>
                            <td> Description Meta English </td>
                            <td><input type="text" class="form-control" name="description_meta_en" required
                                    value="{{ $product->translate('en')->description_meta }}"></td>
                            @if ($errors->has('description_meta_en'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('description_meta_en') }}</strong>
                                </span>
                            @endif
                        </tr>

                        <tr>
                            <td> Keyword Ar </td>
                            <td><input type="text" class="form-control" name="keywords_ar" required
                                    value="{{ $product->translate('ar')->keywords }}"></td>
                            @if ($errors->has('keywords_ar'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('keywords_ar') }}</strong>
                                </span>
                            @endif
                        </tr>

                        <tr>
                            <td> Keywords En </td>
                            <td><input type="text" class="form-control" name="keywords_en" required
                                    value="{{ $product->translate('en')->keywords }}"></td>
                            @if ($errors->has('keywords_en'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('keywords_en') }}</strong>
                                </span>
                            @endif
                        </tr>

                        <tr>
                            <td> Keyword Meta Ar </td>
                            <td><input type="text" class="form-control" name="keywords_meta_ar" required
                                    value="{{ $product->translate('ar')->keywords_meta }}"></td>
                            @if ($errors->has('keywords_meta_ar'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('keywords_meta_ar') }}</strong>
                                </span>
                            @endif
                        </tr>

                        <tr>
                            <td> Keyword Meta En </td>
                            <td><input type="text" class="form-control" name="keywords_meta_en" required
                                    value="{{ $product->translate('en')->keywords_meta }}"></td>
                            @if ($errors->has('keywords_meta_en'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('keywords_meta_en') }}</strong>
                                </span>
                            @endif
                        </tr>
                        <tr>
                            <td>Category</td>
                            <td>
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach ($data['categories'] as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                            {{ $category->translate('ar')->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            @if ($errors->has('category_id'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('category_id') }}</strong>
                                </span>
                            @endif
                        </tr>
                        <tr>
                            <td> select Brand</td>
                            <td>
                                <select name="brand_id" id="brand" class="form-control">
                                    <option value="" > ..select brand.. </option>
                                    @foreach ($data['brands'] as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                                            {{ $brand->translate('ar')->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            @if ($errors->has('brand_id'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('brand_id') }}</strong>
                                </span>
                            @endif
                        </tr>

                        <tr>
                            <td style="width:25%"></td>
                            <td><button type="submit"
                                    class="btn btn-default waves-effect waves-light form-control">Save</button></td>
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
