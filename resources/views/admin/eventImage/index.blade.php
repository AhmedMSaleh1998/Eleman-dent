@extends('layouts.admin')

@section('styles')
<link href="{{ asset('admin_assets/plugins/bootstrap-table/css/bootstrap-table.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin_assets/plugins/custombox/css/custombox.css') }}" rel="stylesheet">
@include('admin._actions_styles')
@stop

@section('content')

<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="main-title-00">
            @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
            @elseif(Session::has('danger'))
            <div class="alert alert-danger">{{ Session::get('danger') }}</div>
            @endif
            <h4 class="page-title">صور وفيديوهات الأحداث</h4>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card-box">

            <div class="row">
                <div class="col-sm-12">
                    <div class=" main-btn-00">
                        <a href="{{ route('admin.eventimage.create', $event_id) }}" class="btn btn-default waves-effect">+ إضافة صورة أو فيديو</a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table data-toggle="table" data-search="true" data-show-columns="true" data-sort-name="id" data-page-list="[8, 16, 32]" data-page-size="8" data-pagination="true" data-show-pagination-switch="true" class="table-bordered ">

                    <thead>
                        <tr>
                            <th data-field="الملف" data-align="center">الملف</th>
                            <th data-field="type" data-align="center">النوع</th>
                            <th data-field="alt" data-align="center">النص البديل للصورة</th>
                            <th data-field="التحكم" data-align="center">التحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($eventImage as $Image)
                        <tr>
                            <td>
                                @if ($Image->type === 'video')
                                <video src="{{ $Image->url }}" width="100" height="100" controls preload="metadata" style="background:#000;border-radius:6px;"></video>
                                @else
                                <img src="{{ $Image->url }}" class="img-responsive" width="100px" height="100px">
                                @endif
                            </td>
                            <td>
                                @if ($Image->type === 'video')
                                <span class="label label-info"><i class="fa fa-video-camera"></i> فيديو</span>
                                @else
                                <span class="label label-default"><i class="fa fa-image"></i> صورة</span>
                                @endif
                            </td>
                            <td>{{ $Image->alt ?: 'لا يوجد'}}</td>

                            <td class="actions">
                                <div class="dropdown action-dd">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle waves-effect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        الإجراءات <i class="fa fa-angle-down"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ route('admin.eventimage.edit', $Image->id) }}" title="تعديل"><i class="fa fa-pencil"></i> تعديل</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="javascript:void(0);" data-toggle="modal" data-target="#{{ $Image->id }}delete" title="حذف"><i class="fa fa-trash"></i> حذف</a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <div id="{{ $Image->id }}delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog" style="width:55%;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="icon error animateErrorIcon" style="display: block;"><span class="x-mark animateXMark"><span class="line left"></span><span class="line right"></span></span></div>
                                        <h4 style="text-align:center;">تأكيد الحذف</h4>
                                    </div>
                                    <div class="modal-footer" style="text-align:center">
                                        <form action="{{ route('admin.eventimage.destroy', $Image->id) }}" method="post">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button class="btn btn-danger" type="submit" dir="ltr">حذف</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('admin_assets/plugins/bootstrap-table/js/bootstrap-table.js') }}"></script>
<script src="{{ asset('admin_assets/pages/jquery.bs-table.js') }}"></script>
<!-- Modal-Effect -->
<script src="{{ asset('admin_assets/plugins/custombox/js/custombox.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/custombox/js/legacy.min.js') }}"></script>
@stop