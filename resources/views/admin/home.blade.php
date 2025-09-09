@extends('layouts.admin')

@section('content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->

<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="main-title-00">
            <h4 class="page-title">الرئيسيه</h4>
            <p class="text-muted page-title-alt">مرحبا فى لوحة ادارة موقع Eleman Dental</p>
        </div>
        @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
        @elseif(Session::has('danger'))
        <div class="alert alert-danger">{{ Session::get('danger') }}</div>
        @endif
    </div>
</div>

<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->

<div class="row">
    <div class="col-md-6 col-lg-6 col-xl-3">
        <a href="{{ route('admin.category.index') }}" class="text-decoration-none">
            <div class="widget-bg-color card-box bg-primary fadeInDown animated">
                <div class="text-right">
                    <h3 class="text-white"><b class="counter">{{$categories}}</b></h3>
                    <p class="text-white mb-0">الأقسام</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>

    <div class="col-md-6 col-lg-6 col-xl-3">
        <a href="{{ route('admin.product.index') }}" class="text-decoration-none">
            <div class="widget-bg-color card-box bg-success">
                <div class="text-right">
                    <h3 class="text-white"><b class="counter">{{$products}}</b></h3>
                    <p class="text-white mb-0">المنتجات</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>

    <div class="col-md-6 col-lg-6 col-xl-3">
        <a href="{{ route('admin.achievement.index') }}" class="text-decoration-none">
            <div class="widget-bg-color card-box bg-danger">
                <div class="text-right">
                    <h3 class="text-white"><b class="counter">{{$achievements}}</b></h3>
                    <p class="text-white mb-0">انجازات</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>

    <div class="col-md-6 col-lg-6 col-xl-3">
        <a href="{{ route('admin.contact.index') }}" class="text-decoration-none">
            <div class="widget-bg-color card-box bg-warning">
                <div class="text-right">
                    <h3 class="text-white"><b class="counter">{{$contacts}}</b></h3>
                    <p class="text-white mb-0">طلبات لم يتم مشاهدتها</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
    
    <div class="col-md-6 col-lg-6 col-xl-3">
        <a href="{{ route('admin.event.index') }}" class="text-decoration-none">
            <div class="widget-bg-color card-box bg-info">
                <div class="text-right">
                    <h3 class="text-white"><b class="counter">{{$events}}</b></h3>
                    <p class="text-white mb-0">ايفنتات</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
    
    <div class="col-md-6 col-lg-6 col-xl-3">
        <a href="{{ route('admin.order.index') }}" class="text-decoration-none">
            <div class="widget-bg-color card-box bg-purple">
                <div class="text-right">
                    <h3 class="text-white"><b class="counter">{{$orders}}</b></h3>
                    <p class="text-white mb-0">اوردرات</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
    
    <div class="col-md-6 col-lg-6 col-xl-3">
        <a href="{{ route('admin.brand.index') }}" class="text-decoration-none">
            <div class="widget-bg-color card-box bg-secondary">
                <div class="text-right">
                    <h3 class="text-white"><b class="counter">{{$brands}}</b></h3>
                    <p class="text-white mb-0">برندات</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
    
    <div class="col-md-6 col-lg-6 col-xl-3">
        <a href="{{ route('admin.city.index') }}" class="text-decoration-none">
            <div class="widget-bg-color card-box bg-dark">
                <div class="text-right">
                    <h3 class="text-white"><b class="counter">{{$cities}}</b></h3>
                    <p class="text-white mb-0">المدن</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
    
    <div class="col-md-6 col-lg-6 col-xl-3">
        <a href="{{ route('admin.banner.index') }}" class="text-decoration-none">
            <div class="widget-bg-color card-box bg-pink">
                <div class="text-right">
                    <h3 class="text-white"><b class="counter">{{$banners}}</b></h3>
                    <p class="text-white mb-0">البنرات</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
    
    <div class="col-md-6 col-lg-6 col-xl-3">
        <a href="{{ route('admin.certificate.index') }}" class="text-decoration-none">
            <div class="widget-bg-color card-box bg-primary">
                <div class="text-right">
                    <h3 class="text-white"><b class="counter">{{$certificates}}</b></h3>
                    <p class="text-white mb-0">شهادات</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
    
    <div class="col-md-6 col-lg-6 col-xl-3">
        <a href="{{ route('admin.review.index') }}" class="text-decoration-none">
            <div class="widget-bg-color card-box bg-success">
                <div class="text-right">
                    <h3 class="text-white"><b class="counter">{{$reviews}}</b></h3>
                    <p class="text-white mb-0">تقييمات</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
    
    <div class="col-md-6 col-lg-6 col-xl-3">
        <a href="{{ route('admin.payment.index') }}" class="text-decoration-none">
            <div class="widget-bg-color card-box bg-danger">
                <div class="text-right">
                    <h3 class="text-white"><b class="counter">{{$paymentMethods}}</b></h3>
                    <p class="text-white mb-0">طرق الدفع</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
    
    <div class="col-md-6 col-lg-6 col-xl-3">
        <a href="{{ route('admin.user.index') }}" class="text-decoration-none">
            <div class="widget-bg-color card-box bg-secondary">
                <div class="text-right">
                    <h3 class="text-white"><b class="counter">{{$users}}</b></h3>
                    <p class="text-white mb-0">المستخدمين</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>

    <div class="col-md-6 col-lg-6 col-xl-3">
        <a href="{{ route('admin.payment.index') }}" class="text-decoration-none">
            <div class="widget-bg-color card-box bg-danger">
                <div class="text-right">
                    <h3 class="text-white"><b class="counter">{{$courses}}</b></h3>
                    <p class="text-white mb-0">الكورسات</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
</div>
@endsection
