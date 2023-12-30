@extends('layouts.admin')

@section('styles')
    <!-- Plugins css-->
    <link href="{{asset('admin_assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css')}}" rel="stylesheet" />
    <link href="{{asset('admin_assets/plugins/switchery/css/switchery.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin_assets/plugins/multiselect/css/multi-select.css')}}"  rel="stylesheet" type="text/css" />
    <link href="{{asset('admin_assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin_assets/plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin_assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin_assets/plugins/bootstrap-table/css/bootstrap-table.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin_assets/plugins/custombox/css/custombox.css')}}" rel="stylesheet">
@endsection

@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @elseif(Session::has('danger'))
                <div class="alert alert-danger">{{ Session::get('danger') }}</div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="header-title m-t-0 m-b-20">تعديل دور</h4>

                <table class="table table-bordered table-striped">
                    {{Form::model($role,['method'=>'PATCH','action' => ['App\Http\Controllers\Admin\RoleController@update',$role->id], 'files' => true])}}
                        <tbody>
                        
                            <tr>
                                <td>الاسم</td>
                                <td>
                                    <input type="text" class="form-control" name="name" value="{{$role->name}}" required>
                                    @if ($errors->has('name'))
                                        <span class="alert alert-danger">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>الأذون</td>
                                <td>
                                    @foreach ($permissions as $permission)
                                        <div class="form-group">
                                            <label for="icon" class="control-label"> @lang('admin.'.$permission->name) </label>
                                            <input type="checkbox" name="permissions[]"  data-plugin="switchery" data-color="#5d9cec" value="{{$permission->id}}" {{$role->hasPermissionTo($permission->name) === true ? 'checked' : ''}}>  
                                        </div>
                                    @endforeach
                                    
                                    @if ($errors->has('permissions'))
                                        <span class="alert alert-danger">
                                            <strong>{{ $errors->first('permissions') }}</strong>
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width:25%"></td>
                                <td><button type="submit" class="btn btn-default waves-effect waves-light form-control">حفظ</button></td>
                            </tr>
                        </tbody>
                    {!! Form::close() !!}
                </table>
            </div>
        </div><!-- end col -->
    </div>
        
@endsection    