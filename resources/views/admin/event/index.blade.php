@extends('layouts.admin')

@section('styles')
<link href="{{asset('admin_assets/plugins/bootstrap-table/css/bootstrap-table.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('admin_assets/plugins/custombox/css/custombox.css')}}" rel="stylesheet">
@include('admin._actions_styles')
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
            
            <h4 class="page-title">الأحداث</h4>
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
                        <a href="{{ route('admin.event.create') }}" class="btn btn-default waves-effect">+ إضافة حدث</a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table data-toggle="table" data-search="true" data-show-columns="true" data-sort-name="id" data-page-list="[8, 16, 32]" data-page-size="8" data-pagination="true" data-show-pagination-switch="true" class="table-bordered ">

                    <thead>
                        <tr>
                            <th data-field="Name Arabic" data-align="center">الاسم بالعربية</th>
                            <th data-field="Name English" data-align="center">الاسم بالإنجليزية</th>
                            <th data-field="Status" data-align="center">الحالة</th>
                            <th data-field="Control" data-align="center">التحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($events))
                        @foreach($events as $event)
                        <tr>
                            <td>{{$event->translate('ar')->name}}</td>
                            <td>{{$event->translate('en')->name}}</td>
                            <td>{{$event->status === 1 ? 'ظاهر' : 'مخفي'}}</td>

                            <td class="actions">
                                <div class="dropdown action-dd">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle waves-effect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        الإجراءات <i class="fa fa-angle-down"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ route('admin.event.edit',$event->id) }}" title="تعديل"><i class="fa fa-pencil"></i> تعديل</a>
                                        <a class="dropdown-item" href="{{ route('admin.event.show',$event->id) }}" title="عرض"><i class="fa fa-eye"></i> عرض</a>
                                        <a class="dropdown-item" href="{{ route('admin.eventimage.index',$event->id) }}" title="صور الحدث"><i class="fa fa-picture-o"></i> صور الحدث</a>
                                        <a class="dropdown-item" href="{{ route('admin.changeStatus',[$event->status,'events',$event->id]) }}" title="تغيير الحالة"><i class="fa {{$event->status == 1 ? 'fa-eye-slash' : 'fa-eye'}}"></i> {{$event->status == 1 ? 'إخفاء' : 'إظهار'}}</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="javascript:void(0);" data-toggle="modal" data-target="#{{$event->id}}delete" title="حذف"><i class="fa fa-trash"></i> حذف</a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <div id="{{$event->id}}delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
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
                                        <form action="{{ route('admin.event.destroy',$event->id) }}" method="POST">
                                            {{csrf_field()}}
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button class="btn btn-danger" type="submit" dir="ltr">حذف</button>
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