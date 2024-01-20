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
            <a style="color: #fff;" href="{{ route('admin.category.index') }}">/ Category / </a>
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
                <h4 class="header-title m-t-0 m-b-20">Edit Category </h4>

                <table class="table table-bordered table-striped">
                    {{ Form::model($category, ['method' => 'PATCH', 'action' => ['App\Http\Controllers\Admin\CategoryController@update', $category->id], 'files' => true]) }}
                    <tbody>
                        <tr>
                            <td>Image</td>
                            <td>
                                <input type="file" class="filestyle" data-placeholder="No file"
                                    data-iconname="fa fa-cloud-upload" name="image">
                                <img src="{{ asset('admin_assets/images/categories/' . $category->image) }}"
                                    class="img-responsive" width="100px" height="100px">
                                @if ($errors->has('image'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif

                            </td>
                        </tr>

                        <tr>
                            <td>Name Arabic </td>
                            <td><input type="text" class="form-control" name="name_ar" required
                                    value="{{ $category->translate('ar')->name }}"></td>
                            @if ($errors->has('name_ar'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('name_ar') }}</strong>
                                </span>
                            @endif
                        </tr>

                        <tr>
                            <td>Name English </td>
                            <td><input type="text" class="form-control" name="name_en" required
                                    value="{{ $category->translate('en')->name }}"></td>
                            @if ($errors->has('name_en'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('name_en') }}</strong>
                                </span>
                            @endif
                        </tr>

                        <tr>
                            <td>Title Arabic </td>
                            <td><input type="text" class="form-control" name="title_ar" required
                                    value="{{ $category->translate('ar')->title }}"></td>
                            @if ($errors->has('title_ar'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('title_ar') }}</strong>
                                </span>
                            @endif
                        </tr>

                        <tr>
                            <td>Title English </td>
                            <td><input type="text" class="form-control" name="title_en" required
                                    value="{{ $category->translate('en')->title }}"></td>
                            @if ($errors->has('title_en'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('title_en') }}</strong>
                                </span>
                            @endif
                        </tr>

                        <tr>
                            <td> Alt Arabic </td>
                            <td><input type="text" class="form-control" name="alt_ar" required
                                    value="{{ $category->translate('ar')->alt }}"></td>
                            @if ($errors->has('alt_ar'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('alt_ar') }}</strong>
                                </span>
                            @endif
                        </tr>

                        <tr>
                            <td> Alt English </td>
                            <td><input type="text" class="form-control" name="alt_en" required
                                    value="{{ $category->translate('en')->alt }}"></td>
                            @if ($errors->has('alt_en'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('alt_en') }}</strong>
                                </span>
                            @endif
                        </tr>

                        <tr>
                            <td> Description Arabic </td>
                            <td><input type="text" class="form-control" name="description_ar" required
                                    value="{{ $category->translate('ar')->description }}"></td>
                            @if ($errors->has('description_ar'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('description_ar') }}</strong>
                                </span>
                            @endif
                        </tr>

                        <tr>
                            <td> Description English </td>
                            <td><input type="text" class="form-control" name="description_en" required
                                    value="{{ $category->translate('en')->description }}"></td>
                            @if ($errors->has('description_en'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('description_en') }}</strong>
                                </span>
                            @endif
                        </tr>

                        <tr>
                            <td> Description Meta Arabic </td>
                            <td><input type="text" class="form-control" name="description_meta_ar" required
                                    value="{{ $category->translate('ar')->description_meta }}"></td>
                            @if ($errors->has('description_meta_ar'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('description_meta_ar') }}</strong>
                                </span>
                            @endif
                        </tr>

                        <tr>
                            <td> Description Meta English </td>
                            <td><input type="text" class="form-control" name="description_meta_en" required
                                    value="{{ $category->translate('en')->description_meta }}"></td>
                            @if ($errors->has('description_meta_en'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('description_meta_en') }}</strong>
                                </span>
                            @endif
                        </tr>

                        <tr>
                            <td> Keyword Ar </td>
                            <td><input type="text" class="form-control" name="keywords_ar" required
                                    value="{{ $category->translate('ar')->keywords }}"></td>
                            @if ($errors->has('keywords_ar'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('keywords_ar') }}</strong>
                                </span>
                            @endif
                        </tr>

                        <tr>
                            <td> Keywords En </td>
                            <td><input type="text" class="form-control" name="keywords_en" required
                                    value="{{ $category->translate('en')->keywords }}"></td>
                            @if ($errors->has('keywords_en'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('keywords_en') }}</strong>
                                </span>
                            @endif
                        </tr>

                        <tr>
                            <td> Keyword Meta Ar </td>
                            <td><input type="text" class="form-control" name="keywords_meta_ar" required
                                    value="{{ $category->translate('ar')->keywords_meta }}"></td>
                            @if ($errors->has('keywords_meta_ar'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('keywords_meta_ar') }}</strong>
                                </span>
                            @endif
                        </tr>

                        <tr>
                            <td> Keyword Meta En </td>
                            <td><input type="text" class="form-control" name="keywords_meta_en" required
                                    value="{{ $category->translate('en')->keywords_meta }}"></td>
                            @if ($errors->has('keywords_meta_en'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('keywords_meta_en') }}</strong>
                                </span>
                            @endif
                        </tr>

                        <tr>
                            <td style="width:25%"></td>
                            <td><button type="submit"
                                    class="btn btn-default waves-effect waves-light form-control">Save</button></td>
                        </tr>
                    </tbody>
                    {!! Form::close() !!}
                </table>
            </div>
        </div><!-- end col -->
    </div>
@endsection
