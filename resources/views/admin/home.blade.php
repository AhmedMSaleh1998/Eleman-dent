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
         <div class="widget-bg-color-icon card-box fadeInDown animated">
             <div class="bg-icon bg-icon-info pull-left">
                 <i class="md md-class text-info"></i>
             </div>
             <div class="text-right">
                 <h3 class="text-dark"><b class="counter">{{$categoryCount}}</b></h3>
                 <p class="text-muted mb-0">الأقسام</p>
             </div>
             <div class="clearfix"></div>
         </div>
     </div>

     <div class="col-md-6 col-lg-6 col-xl-3">
         <div class="widget-bg-color-icon card-box">
             <div class="bg-icon bg-icon-pink pull-left">
                 <i class="md md-shopping-cart text-pink"></i>
             </div>
             <div class="text-right">
                 <h3 class="text-dark"><b class="counter">{{$productCount}}</b></h3>
                 <p class="text-muted mb-0">المنتجات</p>
             </div>
             <div class="clearfix"></div>
         </div>
     </div>

     <div class="col-md-6 col-lg-6 col-xl-3">
         <div class="widget-bg-color-icon card-box">
             <div class="bg-icon bg-icon-pink pull-left">
                 <i class="md md-call text-pink"></i>
             </div>
             <div class="text-right">
                 <h3 class="text-dark"><b class="counter">{{$contactsCount}}</b></h3>
                 <p class="text-muted mb-0">طلبات التواصل</p>
             </div>
             <div class="clearfix"></div>
         </div>
     </div>

     <div class="col-md-6 col-lg-6 col-xl-3">
         <div class="widget-bg-color-icon card-box">
             <div class="bg-icon bg-icon-success pull-left">
                 <i class="md md-email text-success"></i>
             </div>
             <div class="text-right">
                 <h3 class="text-dark"><b class="counter">{{$contactsUnread}}</b></h3>
                 <p class="text-muted mb-0">طلبات التواصل لم يتم مشاهدتها</p>
             </div>
             <div class="clearfix"></div>
         </div>
     </div>
 </div>
 @endsection
