@extends('layouts.admin')

@section('styles')
    <link href="{{ asset('admin_assets/plugins/bootstrap-table/css/bootstrap-table.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('admin_assets/plugins/custombox/css/custombox.css') }}" rel="stylesheet">
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

                <h4 class="page-title">البانرز</h4>
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
                            <a href="{{ route('admin.banner.create') }}" class="btn btn-default waves-effect">+ إضافة بانر</a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table data-toggle="table" data-search="true" data-show-columns="true" data-sort-name="id"
                        data-page-list="[8, 16, 32]" data-page-size="8" data-pagination="true"
                        data-show-pagination-switch="true" class="table-bordered ">

                        <thead>
                            <tr>
                                <th data-field="Image" data-align="center">الصورة</th>
                                <th data-field="alt_ar" data-align="center">النص البديل بالعربية</th>
                                <th data-field="alt_en" data-align="center">النص البديل بالإنجليزية</th>
                                <th data-field="Url" data-align="center">الرابط</th>
                                <th data-field="Status" data-align="center">الحالة</th>
                                <th data-field="Control" data-align="center">التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($banners))
                                @foreach ($banners as $banner)
                                    <tr>
                                        <td><img src="{{ asset('admin_assets/images/banners/' . $banner->image) }}"
                                                class="img-responsive" width="100px" height="100px"></td>
                                        <td>{{ $banner->translate('ar')->alt }}</td>
                                        <td>{{ $banner->translate('ar')->alt }}</td>
                                        <td>{{ $banner->url }}</td>
                                        <td>{{ $banner->status === 1 ? 'ظاهر' : 'مخفي' }}</td>
                                        <td class="actions">
                                            <div class="dropdown action-dd">
                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle waves-effect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    الإجراءات <i class="fa fa-angle-down"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{ route('admin.banner.edit', $banner->id) }}"><i class="fa fa-pencil"></i> تعديل</a>
                                                    <a class="dropdown-item" href="{{ route('admin.changeStatus', [$banner->status, 'banners', $banner->id]) }}"><i class="fa fa-eye{{ $banner->status == 1 ? '-slash' : '' }}"></i> {{ $banner->status == 1 ? 'إخفاء' : 'إظهار' }}</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item text-danger" href="javascript:void(0);" data-toggle="modal" data-target="#{{ $banner->id }}delete"><i class="fa fa-trash"></i> حذف</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <div id="{{ $banner->id }}delete" class="modal fade" tabindex="-1" role="dialog"
                                        aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog" style="width:55%;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="icon error animateErrorIcon" style="display: block;"><span
                                                            class="x-mark animateXMark"><span class="line left"></span><span
                                                                class="line right"></span></span></div>
                                                    <h4 style="text-align:center;">تأكيد الحذف</h4>
                                                </div>
                                                <div class="modal-footer" style="text-align:center">
                                                    <form
                                                        action="{{ action('App\Http\Controllers\Admin\BannerController@destroy', $banner['id']) }}"
                                                        method="post">
                                                        {{ csrf_field() }}
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button class="btn btn-danger" type="submit"
                                                            dir="ltr">حذف</button>
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
    <script src="{{ asset('admin_assets/plugins/bootstrap-table/js/bootstrap-table.js') }}"></script>
    <script src="{{ asset('admin_assets/pages/jquery.bs-table.js') }}"></script>
    <!-- Modal-Effect -->
    <script src="{{ asset('admin_assets/plugins/custombox/js/custombox.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/custombox/js/legacy.min.js') }}"></script>
@stop
