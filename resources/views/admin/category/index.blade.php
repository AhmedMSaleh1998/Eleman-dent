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

                <h4 class="page-title">الأقسام</h4>
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
                            <a href="{{ route('admin.category.create') }}" class="btn btn-default waves-effect">+ إضافة قسم</a>
                            <button type="button" class="btn btn-info waves-effect" data-toggle="modal"
                                data-target="#categoryTreePreview" title="عرض رسم توضيحي لهيكل الأقسام">
                                معاينة شجرة الأقسام
                            </button>
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
                                <th data-field="Name Arabic" data-align="center">الاسم بالعربية</th>
                                <th data-field="Name English" data-align="center">الاسم بالإنجليزية</th>
                                <th data-field="Parent" data-align="center">القسم الأب</th>
                                <th data-field="Status" data-align="center">الحالة</th>
                                <th data-field="Control" data-align="center">التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($categories))
                                @foreach ($categories as $category)
                                    <tr>
                                        <td><img src="{{ asset('admin_assets/images/categories/' . $category->image) }}"
                                                class="img-responsive" width="100px" height="100px"></td>
                                        <td>{{ $category->translate('ar')->name }}</td>
                                        <td>{{ $category->translate('en')->name }}</td>
                                        <td>{{ $category->parent ? optional($category->parent->translate('ar'))->name : '— رئيسي —' }}</td>
                                        <td>{{ $category->status === 1 ? 'ظاهر' : 'مخفي' }}</td>

                                        <td class="actions">
                                            <div class="dropdown action-dd">
                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle waves-effect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    الإجراءات <i class="fa fa-angle-down"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{ route('admin.category.edit', $category->id) }}"><i class="fa fa-pencil"></i> تعديل</a>
                                                    <a class="dropdown-item" href="{{ route('admin.changeStatus', [$category->status, 'categories', $category->id]) }}"><i class="fa fa-eye{{ $category->status == 1 ? '-slash' : '' }}"></i> {{ $category->status == 1 ? 'إخفاء' : 'إظهار' }}</a>
                                                    <a class="dropdown-item" href="{{ route('admin.category.create', ['parent_id' => $category->id]) }}" title="إضافة قسم فرعي داخل هذا القسم"><i class="fa fa-plus"></i> + قسم فرعي</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item text-danger" href="javascript:void(0);" data-toggle="modal" data-target="#{{ $category->id }}delete"><i class="fa fa-trash"></i> حذف</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <div id="{{ $category->id }}delete" class="modal fade" tabindex="-1" role="dialog"
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
                                                    <form action="{{ route('admin.category.destroy', $category->id) }}"
                                                        method="POST">
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

    <!-- Category Tree Preview Modal -->
    <div id="categoryTreePreview" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog" style="width:70%; max-width:900px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 style="margin:0; text-align:center;">الرسم التوضيحي لهيكل الأقسام</h4>
                </div>
                <div class="modal-body cat-tree-wrap" dir="ltr">
                    @php
                        $byParent = $categories->groupBy(function ($item) {
                            return $item->parent_id ?: 0;
                        });
                        $rootNodes = $byParent->get(0, collect());
                    @endphp
                    @if ($rootNodes->isEmpty())
                        <p class="text-center">لا توجد أقسام حتى الآن.</p>
                    @else
                        {{-- الجذر: كل الأقسام الرئيسية بتتفرع منه --}}
                        <div class="cat-tree__rootnode">
                            <i class="fa fa-sitemap"></i>
                            جميع الأقسام
                            <span class="cat-tree__rootcount">{{ $categories->count() }} قسم ({{ $rootNodes->count() }} رئيسي)</span>
                        </div>
                        <div class="cat-tree--under-root">
                            @include('admin.category._tree', ['nodes' => $rootNodes, 'byParent' => $byParent])
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        .cat-tree-wrap {
            max-height: 70vh;
            overflow: auto;
            padding: 20px 25px;
            background: #fafbfc;
        }

        .cat-tree,
        .cat-tree ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        /* عقدة الجذر اللي كل الأقسام بتتفرع منها */
        .cat-tree__rootnode {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #2d3b48;
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            border-radius: 8px;
            padding: 10px 18px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        .cat-tree__rootcount {
            font-size: 11.5px;
            font-weight: 400;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 999px;
            padding: 3px 10px;
        }

        /* خطوط توضيحية بتربط الفروع بالأصل — على كل المستويات بما فيها الأول */
        .cat-tree--under-root > .cat-tree,
        .cat-tree .cat-tree {
            margin-left: 21px;
            padding-left: 24px;
            border-left: 2px dashed #b8c4ce;
        }

        .cat-tree li {
            position: relative;
            padding-top: 10px;
        }

        .cat-tree > li::before {
            content: '';
            position: absolute;
            top: 32px;
            left: -24px;
            width: 20px;
            border-top: 2px dashed #b8c4ce;
        }

        /* قص الخط الرأسي الزائد بعد آخر فرع */
        .cat-tree > li:last-child::after {
            content: '';
            position: absolute;
            left: -27px;
            top: 34px;
            bottom: 0;
            width: 5px;
            background: #fafbfc;
        }

        .cat-tree__card {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #fff;
            border: 1px solid #dde3e8;
            border-radius: 8px;
            padding: 8px 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .cat-tree__card--hidden {
            opacity: 0.55;
            background: #f4f4f4;
        }

        .cat-tree__img {
            width: 42px;
            height: 42px;
            object-fit: contain;
            border-radius: 6px;
            border: 1px solid #eee;
            background: #fff;
            flex: 0 0 auto;
        }

        .cat-tree__names {
            display: flex;
            flex-direction: column;
            line-height: 1.3;
            min-width: 0;
        }

        .cat-tree__names strong {
            font-size: 14px;
        }

        .cat-tree__names small {
            color: #7a8791;
        }

        .cat-tree__badge {
            font-size: 11px;
            font-weight: 700;
            padding: 2px 10px;
            border-radius: 999px;
        }

        .cat-tree__badge--on {
            background: #e6f7ef;
            color: #1a9e60;
        }

        .cat-tree__badge--off {
            background: #fdeaea;
            color: #c0392b;
        }

        .cat-tree__count {
            font-size: 11.5px;
            color: #7a8791;
            white-space: nowrap;
        }

        .cat-tree__actions {
            margin-left: auto;
            display: inline-flex;
            gap: 6px;
            white-space: nowrap;
        }
    </style>

@endsection

@section('scripts')
    <script src="{{ asset('admin_assets/plugins/bootstrap-table/js/bootstrap-table.js') }}"></script>
    <script src="{{ asset('admin_assets/pages/jquery.bs-table.js') }}"></script>
    <!-- Modal-Effect -->
    <script src="{{ asset('admin_assets/plugins/custombox/js/custombox.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/custombox/js/legacy.min.js') }}"></script>
@stop
