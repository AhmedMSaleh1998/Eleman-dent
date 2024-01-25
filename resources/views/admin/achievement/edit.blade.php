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
            <a style="color: #fff;" href="{{ route('admin.achievement.index') }}">/ Achievement / </a>
            <a style="color: #36404a;"> Edit </a>

          
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="header-title m-t-0 m-b-20">Edit Achievement </h4>

                <table class="table table-bordered table-striped">
                    {{ Form::model($achievement, ['method' => 'PATCH', 'action' => ['App\Http\Controllers\Admin\AchievementController@update', $achievement->id], 'files' => true]) }}
                    <tbody>
                       
                        <tr>
                            <td>Name Arabic </td>
                            <td><input type="text" class="form-control" name="name_ar" required
                                    value="{{ $achievement->translate('ar')->name }}"></td>
                            @if ($errors->has('name_ar'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('name_ar') }}</strong>
                                </span>
                            @endif
                        </tr>

                        <tr>
                            <td>Name English </td>
                            <td><input type="text" class="form-control" name="name_en" required
                                    value="{{ $achievement->translate('en')->name }}"></td>
                            @if ($errors->has('name_en'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('name_en') }}</strong>
                                </span>
                            @endif
                        </tr>

                        <tr>
                            <td> Value </td>
                            <td><input type="number" step="1" class="form-control" name="value" required
                                    value="{{ $achievement->value }}"></td>
                            @if ($errors->has('value'))
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('value') }}</strong>
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
