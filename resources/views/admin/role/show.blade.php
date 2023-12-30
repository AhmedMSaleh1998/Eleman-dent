@extends('layouts.admin')

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
                <h4 class="header-title m-t-0 m-b-20">{{$role->name}}</h4>

                <table class="table table-bordered table-striped">
                    <tbody>
                        @for($i=0; $i<count($permissions); $i++)
                        <tr>
                            <td>@lang('admin.'.$permissions[$i]['name'])</td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div><!-- end col -->
    </div>
        
@endsection