@extends('layouts.admin')

@section('styles')
<link href="{{asset('admin_assets/plugins/bootstrap-table/css/bootstrap-table.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('admin_assets/plugins/custombox/css/custombox.css')}}" rel="stylesheet">
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
            <h4 class="page-title">المنتجات</h4>
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
                        <a href="{{ route('admin.product.create') }}" class="btn btn-default waves-effect">+ إضافة منتج</a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table data-toggle="table" data-search="true" data-show-columns="true" data-sort-name="id" data-page-list="[8, 16, 32]" data-page-size="8" data-pagination="true" data-show-pagination-switch="true" class="table-bordered ">

                    <thead>
                        <tr>
                            <th data-field="Id" data-align="center">الرقم</th>
                            <th data-field="Image" data-align="center">الصورة</th>
                            <th data-field="Product Name" data-align="center">اسم المنتج</th>
                            <th data-field="Price" data-align="center">السعر</th>
                            <th data-field="Quantity" data-align="center">الكمية</th>
                            <th data-field="Order" data-align="center">الترتيب</th>
                            <th data-field="Top Products" data-align="center">منتج مميز</th>
                            <th data-field="Status" data-align="center">الحالة</th>
                            <th data-field="Control" data-align="center">التحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($products))
                        @foreach($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td><img src="{{asset('admin_assets/images/products/'.$product->image)}}" class="img-responsive" width="100px" height="100px"></td>
                            <td>{{$product->translate('ar')->name}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>{{$product->seq}}</td>
                            <td>{{$product->is_top_product ? 'نعم' : 'لا'}}</td>
                            <td>{{$product->status === 1 ? 'ظاهر' : 'مخفي'}}</td>

                            <td class="actions">
                                <div class="dropdown action-dd">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle waves-effect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        الإجراءات <i class="fa fa-angle-down"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ route('admin.product.edit',$product->id) }}" title="تعديل"><i class="fa fa-pencil"></i> تعديل</a>
                                        <a class="dropdown-item" href="{{ route('admin.product.show',$product->id) }}" title="عرض التفاصيل"><i class="fa fa-eye"></i> عرض</a>
                                        <a class="dropdown-item" href="{{ route('admin.productimage.index',$product->id) }}" title="صور المنتج"><i class="fa fa-picture-o"></i> صور المنتج</a>
                                        <a class="dropdown-item" href="{{ route('admin.product.topProduct',$product->id) }}" title="منتج مميز — يظهر في الرئيسية"><i class="fa {{$product->is_top_product ? 'fa-star-o' : 'fa-star'}}"></i> {{$product->is_top_product ? 'إلغاء التمييز' : 'تمييز'}}</a>
                                        <a class="dropdown-item" href="{{ route('admin.changeStatus',[$product->status,'products',$product->id]) }}" title="تغيير الحالة"><i class="fa {{$product->status == 1 ? 'fa-eye-slash' : 'fa-eye'}}"></i> {{$product->status == 1 ? 'إخفاء' : 'إظهار'}}</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="javascript:void(0);" data-toggle="modal" data-target="#{{$product->id}}delete" title="حذف"><i class="fa fa-trash"></i> حذف</a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <div id="{{$product->id}}delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
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
                                        <form action="{{ route('admin.product.destroy',$product->id) }}" method="POST">
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
