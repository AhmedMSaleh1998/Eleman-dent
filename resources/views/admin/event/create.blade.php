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
            <a style="color: #fff;" href="{{ route('admin.event.index') }}">/ Event / </a>
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
                <h4 class="header-title m-t-0 m-b-20">Event Add</h4>

                <table class="table table-bordered table-striped">
                    {{ Form::open(['method' => 'POST', 'action' => ['App\Http\Controllers\Admin\EventController@store'], 'files' => true]) }}
                    @csrf
                    <tbody>

                        <tr>
                            <td>image</td>
                            <td>
                                <input type="file" class="filestyle" data-placeholder="No file"
                                    data-iconname="fa fa-cloud-upload" name="image" required>
                                @if ($errors->has('image'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif

                            </td>
                        </tr>
                        <tr>
                            <td>Name Ar</td>
                            <td><input type="text" class="form-control" name="name_ar" required></td>
                            @if ($errors->has('name_ar'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('name_ar') }}</strong>
                                </span>
                            @endif
                        </tr>
                        <tr>
                            <td>Name En</td>
                            <td><input type="text" class="form-control" name="name_en" required></td>
                            @if ($errors->has('name_en'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('name_en') }}</strong>
                                </span>
                            @endif
                        </tr>

                        <td>Description Ar</td>
                        <td><input type="text" class="form-control" name="description_ar" required></td>
                        @if ($errors->has('description_ar'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('description_ar') }}</strong>
                            </span>
                        @endif
                        </tr>
                        <tr>
                            <td>Description Ar</td>
                            <td><input type="text" class="form-control" name="description_en" required></td>
                            @if ($errors->has('description_en'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('description_en') }}</strong>
                                </span>
                            @endif
                        </tr>
                        <tr>
                            <td>Location Ar</td>
                            <td><input type="text" class="form-control" name="location_ar" required></td>
                            @if ($errors->has('location_ar'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('location_ar') }}</strong>
                                </span>
                            @endif
                        </tr>
                        <tr>
                            <td>Location En</td>
                            <td><input type="text" class="form-control" name="location_en" required></td>
                            @if ($errors->has('location_en'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('location_en') }}</strong>
                                </span>
                            @endif
                        </tr>
                        <tr>
                            <td for="date">Select a Date:</label></td>
                            <td> <input type="date" id="date" name="date"></td>
                            @if ($errors->has('date'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('date') }}</strong>
                                </span>
                            @endif
                        </tr>
                        <tr>
                            <td style="width:25%"></td>
                            <td><button type="submit"
                                    class="btn btn-default waves-effect waves-light form-control">Save</button></td>
                        </tr>
                    </tbody>
                    {{-- </form> --}}
                    {!! Form::close() !!}
                </table>
            </div>
        </div><!-- end col -->
    </div>
@endsection
