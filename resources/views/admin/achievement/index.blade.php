@extends('layouts.admin')

@section('styles')
<link href="{{asset('admin_assets/plugins/bootstrap-table/css/bootstrap-table.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('admin_assets/plugins/custombox/css/custombox.css')}}" rel="stylesheet">
@stop

@section('content')

<!-- Page-Title -->
@if (Session::has('success'))
            <div class="alert alert-success text-center">{{ Session::get('success') }}</div>
            @elseif(Session::has('danger'))
            <div class="alert alert-danger text-center">{{ Session::get('danger') }}</div>
            @endif
<div class="row">
    <div class="col-sm-12">
        <div class="main-title-00">
            
            <h4 class="page-title">Achievements</h4>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card-box">

            <div class="row">
                <div class="col-sm-12">
                    <div class=" main-btn-00">
                        <!-- Responsive modal -->
                        <a href="{{ route('admin.achievement.create') }}" class="btn btn-default waves-effect">Add Achievement +</a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table data-toggle="table" data-search="true" data-show-columns="true" data-sort-name="id" data-page-list="[8, 16, 32]" data-page-size="8" data-pagination="true" data-show-pagination-switch="true" class="table-bordered ">

                    <thead>
                        <tr>
                            <th data-field="Image" data-align="center">Image</th>
                            <th data-field="Name Arabic" data-align="center">Name Arabic</th>
                            <th data-field="Name English" data-align="center">Name English</th>
                            <th data-field="Value" data-align="center">Value</th>
                            <th data-field="Control" data-align="center">Control</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($achievements))
                        @foreach($achievements as $achievement)
                        <tr>
                        <td><img src="{{ asset('admin_assets/images/achievements/' . $achievement->image) }}"
                                                class="img-responsive" width="100px" height="100px"></td>
                            <td>{{$achievement->translate('ar')->name}}</td>
                            <td>{{$achievement->translate('en')->name}}</td>
                            <td>{{$achievement->value}}</td>

                            <td class="actions">
                                <a href="{{ route('admin.achievement.edit',$achievement->id) }}" class="btn btn-success waves-effect" title="Edit">Edit</a>
                                <button type="button" class="btn btn-danger waves-effect" data-toggle="modal" data-target="#{{$achievement->id}}delete" title="Delete">Delete </button>
                            </td>
                        </tr>

                        <div id="{{$achievement->id}}delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog" style="width:55%;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="icon error animateErrorIcon" style="display: block;"><span class="x-mark animateXMark"><span class="line left"></span><span class="line right"></span></span></div>
                                        <h4 style="text-align:center;">Confirm delete this achievement</h4>
                                    </div>
                                    <div class="modal-footer" style="text-align:center">
                                        <form action="{{ route('admin.achievement.destroy',$achievement->id) }}" method="POST">
                                            {{csrf_field()}}
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button class="btn btn-danger" type="submit" dir="ltr">Delete</button>
                                        </form>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div> <!-- end col -->

</div>

@endsection

@section('scripts')
<script src="{{asset('admin_assets/plugins/bootstrap-table/js/bootstrap-table.js')}}"></script>
<script src="{{asset('admin_assets/pages/jquery.bs-table.js')}}"></script>
<!-- Modal-Effect -->
<script src="{{asset('admin_assets/plugins/custombox/js/custombox.min.js')}}"></script>
<script src="{{asset('admin_assets/plugins/custombox/js/legacy.min.js')}}"></script>
@stop