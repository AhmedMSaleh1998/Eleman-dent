@extends('layouts.admin')

@section('styles')
<link href="{{asset('admin_assets/plugins/bootstrap-table/css/bootstrap-table.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('admin_assets/plugins/custombox/css/custombox.css')}}" rel="stylesheet">
@include('admin._actions_styles')
<style>
    .products-toolbar {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin: 18px 0 14px;
    }

    .toolbar-group {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin: 0;
        padding: 10px 14px;
        background: #f7f9fb;
        border: 1px solid #e4e9ef;
        border-radius: 8px;
    }

    .toolbar-group--move {
        background: #fff9ee;
        border-color: #f1e2c3;
    }

    .toolbar-group__title {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-weight: 700;
        color: #43525f;
        white-space: nowrap;
        margin-inline-end: 4px;
    }

    .toolbar-group__title .fa {
        color: #26a69a;
    }

    .toolbar-group--move .toolbar-group__title .fa {
        color: #e6a23c;
    }

    .toolbar-group select.form-control {
        width: auto;
        min-width: 175px;
        max-width: 240px;
        height: 34px;
        padding: 4px 10px;
        font-size: 13px;
        border-radius: 6px;
        border-color: #d8dfe6;
        background-color: #fff;
    }

    .toolbar-group .btn-sm {
        border-radius: 6px;
        padding: 6px 14px;
    }

    .toolbar-group .btn[disabled] {
        opacity: .55;
        cursor: not-allowed;
    }

    .toolbar-count {
        padding: 4px 12px;
        border-radius: 999px;
        background: #e5f5f2;
        color: #1a8b7d;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .toolbar-hint {
        font-size: 11.5px;
        color: #9aa5b1;
        white-space: nowrap;
    }

    /* عمود التحديد */
    #products-table th.bs-checkbox,
    #products-table td.bs-checkbox {
        vertical-align: middle;
    }

    /* تعديل الترتيب السريع */
    .seq-input {
        width: 72px;
        height: 32px;
        padding: 2px 6px;
        text-align: center;
        font-size: 13px;
        border: 1px solid #d8dfe6;
        border-radius: 6px;
        background: #fff;
        transition: border-color .15s, box-shadow .15s, opacity .15s;
    }

    .seq-input:focus {
        outline: none;
        border-color: #26a69a;
    }

    .seq-input.is-saving {
        opacity: .55;
    }

    .seq-input.is-saved {
        border-color: #26a69a;
        box-shadow: 0 0 0 2px rgba(38, 166, 154, .2);
    }

    .seq-input.is-error {
        border-color: #e74c3c;
        box-shadow: 0 0 0 2px rgba(231, 76, 60, .18);
    }
</style>
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

            <div class="products-toolbar">
                <!-- فلترة بالقسم / الماركة -->
                <form method="GET" action="{{ route('admin.product.index') }}" class="toolbar-group">
                    <span class="toolbar-group__title"><i class="fa fa-filter"></i> تصفية</span>
                    <select name="category_id" class="form-control">
                        <option value="">كل الأقسام</option>
                        @foreach($data['categories'] as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ optional($category->translate('ar'))->name }}
                            </option>
                        @endforeach
                    </select>
                    <select name="brand_id" class="form-control">
                        <option value="">كل الماركات</option>
                        @foreach($data['brands'] as $brand)
                            <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                                {{ optional($brand->translate('ar'))->name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary btn-sm waves-effect"><i class="fa fa-search"></i> فلترة</button>
                    @if(request('category_id') || request('brand_id'))
                        <a href="{{ route('admin.product.index') }}" class="btn btn-light btn-sm waves-effect"><i class="fa fa-times"></i> إعادة تعيين</a>
                    @endif
                    <span class="toolbar-count">{{ count($products) }} منتج</span>
                </form>

                <!-- نقل جماعي لقسم آخر -->
                <form action="{{ route('admin.product.bulkMoveCategory') }}" method="POST" id="bulk-move-form" class="toolbar-group toolbar-group--move">
                    {{ csrf_field() }}
                    <input type="hidden" name="product_ids" id="bulk-product-ids">
                    <span class="toolbar-group__title"><i class="fa fa-exchange"></i> نقل جماعي</span>
                    <select name="category_id" class="form-control" required>
                        <option value="">اختر القسم الجديد...</option>
                        @foreach($data['categories'] as $category)
                            <option value="{{ $category->id }}">{{ optional($category->translate('ar'))->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" id="bulk-move-btn" class="btn btn-warning btn-sm waves-effect" disabled>
                        <i class="fa fa-arrow-left"></i> نقل المحدد (<span id="bulk-selected-count">0</span>)
                    </button>
                    <span class="toolbar-hint">حدد المنتجات من أول عمود في الجدول</span>
                </form>
            </div>

            <div class="table-responsive">
                <table id="products-table" data-toggle="table" data-search="true" data-show-columns="true" data-sort-name="id" data-page-list="[8, 16, 32, 100, All]" data-page-size="8" data-pagination="true" data-show-pagination-switch="true" data-maintain-selected="true" class="table-bordered ">

                    <thead>
                        <tr>
                            <th data-field="state" data-checkbox="true"></th>
                            <th data-field="Id" data-align="center">الرقم</th>
                            <th data-field="Image" data-align="center">الصورة</th>
                            <th data-field="Product Name" data-align="center">اسم المنتج</th>
                            <th data-field="Category" data-align="center">القسم</th>
                            <th data-field="Brand" data-align="center">الماركة</th>
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
                        @php
                            // القسم من جدول الربط، ولو فاضي نرجع لعمود category_id
                            $categoryNames = $product->categories->map(function ($cat) {
                                return optional($cat->translate('ar'))->name;
                            })->filter();
                            if ($categoryNames->isEmpty() && $product->category) {
                                $categoryNames = collect([optional($product->category->translate('ar'))->name])->filter();
                            }
                        @endphp
                        <tr>
                            <td></td>
                            <td>{{$product->id}}</td>
                            <td><img src="{{asset('admin_assets/images/products/'.$product->image)}}" class="img-responsive" width="100px" height="100px"></td>
                            <td>{{$product->translate('ar')->name}}</td>
                            <td>{{ $categoryNames->implode('، ') ?: '-' }}</td>
                            <td>{{ $product->brand ? optional($product->brand->translate('ar'))->name : '-' }}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>
                                <input type="number" class="seq-input" min="0" value="{{ $product->seq }}"
                                    data-id="{{ $product->id }}" data-original="{{ $product->seq }}"
                                    title="غيّر الرقم وسيتم الحفظ تلقائياً">
                            </td>
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
<script>
    $(function () {
        var $table = $('#products-table');

        function getSelectedIds() {
            return $table.bootstrapTable('getSelections').map(function (row) { return row.Id; });
        }

        function refreshBulkState() {
            var count = getSelectedIds().length;
            $('#bulk-selected-count').text(count);
            $('#bulk-move-btn').prop('disabled', count === 0);
        }

        $table.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table post-body.bs.table', refreshBulkState);
        refreshBulkState();

        // نص واضح لزر إظهار/إخفاء تقسيم الصفحات بدل الأيقونة
        function labelPaginationSwitch() {
            var paginated = $table.bootstrapTable('getOptions').pagination;
            $table.closest('.bootstrap-table').find('button[name="paginationSwitch"]')
                .html(paginated ? '<i class="fa fa-list"></i> عرض الكل' : '<i class="fa fa-columns"></i> تقسيم لصفحات')
                .attr('title', paginated ? 'عرض كل المنتجات في صفحة واحدة' : 'الرجوع للتقسيم على صفحات');
        }
        labelPaginationSwitch();
        $(document).on('click', 'button[name="paginationSwitch"]', function () {
            setTimeout(labelPaginationSwitch, 0);
        });

        // تعديل الترتيب السريع من القائمة
        $table.on('change', '.seq-input', function () {
            var $input = $(this);
            var id = $input.data('id');
            var original = String($input.data('original'));
            var seq = $input.val();

            if (seq === '' || +seq < 0) {
                $input.val(original);
                return;
            }
            if (String(+seq) === original) return;

            $input.addClass('is-saving').prop('disabled', true);
            $.post("{{ route('admin.product.updateSeq', ':id') }}".replace(':id', id), {
                _token: '{{ csrf_token() }}',
                seq: seq
            }).done(function () {
                $input.data('original', String(+seq));
                $input.attr('value', seq).attr('data-original', seq);
                $input.removeClass('is-error').addClass('is-saved');
                setTimeout(function () { $input.removeClass('is-saved'); }, 1200);
                // تحديث نسخة الجدول الداخلية عشان القيمة الجديدة تفضل بعد التنقل بين الصفحات
                try {
                    var index = $input.closest('tr').data('index');
                    $table.bootstrapTable('updateCell', { index: index, field: 'Order', value: $input.closest('td').html(), reinit: false });
                } catch (err) { /* لو النسخة القديمة مش بتدعمها مش مشكلة */ }
            }).fail(function () {
                $input.val(original);
                $input.addClass('is-error');
                setTimeout(function () { $input.removeClass('is-error'); }, 2000);
                alert('حصل خطأ أثناء حفظ الترتيب، حاول مرة أخرى');
            }).always(function () {
                $input.removeClass('is-saving').prop('disabled', false).focus();
            });
        });

        $('#bulk-move-form').on('submit', function (e) {
            var ids = getSelectedIds();
            if (!ids.length) {
                e.preventDefault();
                alert('اختر منتج واحد على الأقل من الجدول أولاً');
                return false;
            }
            if (!confirm('سيتم نقل ' + ids.length + ' منتج إلى القسم المختار، هل أنت متأكد؟')) {
                e.preventDefault();
                return false;
            }
            $('#bulk-product-ids').val(ids.join(','));
        });
    });
</script>
@stop
