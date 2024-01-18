<!DOCTYPE html>

<html dir="rtl">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="author" content="Coderthemes">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('admin_assets/images/logo.png') }}">

    <title>Eleman Dental</title>

    <!--Morris Chart CSS -->

    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/morris/morris.css') }}">

    <link href=" {{ asset('admin_assets/plugins/bootstrap-sweetalert/sweet-alert.css') }}" rel="stylesheet" type="text/css">

    <link href=" {{ asset('admin_assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">

    <link href="{{ asset('admin_assets/css/icons.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('admin_assets/css/style.css') }}" rel="stylesheet" type="text/css" />

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <link href="{{ asset('admin_assets/css/new_style.css') }}" rel="stylesheet" type="text/css" />

    {{-- <link href="{{asset('admin_assets/scss/_menu.scss')}}" rel="stylesheet" type="text/css" /> --}}

    <script src="{{ asset('admin_assets/js/modernizr.min.js') }}"></script>

    @yield('styles')

</head>

<body class="fixed-left">

    <!-- Begin page -->

    <div id="wrapper">

        <!-- Top Bar Start -->

        <div class="topbar">

            <!-- LOGO -->

            <div class="topbar-left">

                <div class="text-center">

                    <a href="{{ route('admin.home') }}" class="logo" dir="rtl">
                        <i class="icon-c-logo"></i>
                        <span>
                            Eleman Dashboard
                        </span>
                    </a>

                </div>

            </div>

            <!-- Button mobile view to collapse sidebar menu -->

            <nav class="navbar-custom">

                <ul class="list-inline float-left mb-0">

                    <!--full screen button-->

                    <li class="list-inline-item notification-list">

                        <a class="nav-link waves-light waves-effect" href="#" id="btn-fullscreen">

                            <i class="dripicons-expand noti-icon"></i>

                        </a>

                    </li>

                    <!--logout dropdown button-->

                    <li class="list-inline-item dropdown notification-list">

                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">

                            <img src="{{ asset('admin_assets/images/favicon_1.ico') }}" style="" alt="user" class="rounded-circle">

                        </a>

                        <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">

                            <!-- admin name-->

                            <div class="dropdown-item noti-title">

                                {{-- <h5 class="text-overflow"><small>مرحبا {{ Auth::user()->name }}</small> </h5> --}}

                            </div>

                            <!-- logout-->

                            <a class="dropdown-item notify-item" href="{{ url('logout') }}" onclick="event.preventDefault();

                                                 document.getElementById('logout-form').submit();">

                                <i class="zmdi zmdi-power"></i> <span>تسجيل خروج</span>

                                <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">

                                    {{ csrf_field() }}

                                </form>

                            </a>

                        </div>

                    </li>

                </ul>

                <!--left sidebar toggle-->

                <ul class="list-inline menu-left mb-0">

                    <li class="float-right">

                        <button class="button-menu-mobile open-left waves-light waves-effect">

                            <i class="dripicons-menu"></i>

                        </button>

                    </li>

                </ul>

            </nav>

        </div>

        <!-- Top Bar End -->

        <!-- ============================================================== -->

        <!-- Start right Content here -->

        <!-- ============================================================== -->

        <div class="content-page">

            <!-- Start content -->

            <div class="content">

                <div class="container-fluid">

                    @yield('content')

                </div> <!-- container -->

            </div> <!-- content -->

            <footer class="footer text-right">

                <a href="https://www.linkedin.com/in/ahmed-saleh-50b36b225/" target="_blank"> Ahmed Saleh Web Developer</a> &copy; <?php echo now()->year; ?> All rights reserved.

            </footer>

        </div>

        <!-- ============================================================== -->

        <!-- End Right content here -->

        <!-- ============================================================== -->

        <!-- ========== Left Sidebar Start ========== -->

        <div class="left side-menu">

            <div class="sidebar-inner slimscrollleft">

                <!--- Divider -->

                <div id="sidebar-menu">

                    <ul>

                        <li><a href="{{ route('admin.home') }}" class="waves-effect"><i class="ti-home"></i> <span>Home </span></a></li>
                        <li><a href="{{ route('admin.category.index') }}" class="waves-effect"><i class="ion-ios7-information-outline"></i> <span> Categories </span></a></li>
                        <li><a href="{{ route('admin.city.index') }}" class="waves-effect"><i class="ion-ios7-information-outline"></i> <span> Cities </span></a></li>
                        <!-- <li><a href="{{ route('admin.color.index') }}" class="waves-effect"><i class="ion-ios7-information-outline"></i> <span> الألوان </span></a></li> -->
                        <!-- <li><a href="{{ route('admin.type.index') }}" class="waves-effect"><i class="ion-ios7-information-outline"></i> <span> الأنواع </span></a></li> -->
                        <li><a href="{{ route('admin.product.index') }}" class="waves-effect"><i class="ion-ios7-information-outline"></i> <span> Products </span></a></li>
                        <li><a href="{{ route('admin.order.index') }}" class="waves-effect"><i class="ion-ios7-information-outline"></i> <span> Orders </span></a></li>
                        <li><a href="{{ route('admin.user.index') }}" class="waves-effect"><i class="ion-ios7-information-outline"></i> <span> Users </span></a></li>
                        <li><a href="{{ route('admin.slider.index') }}" class="waves-effect"><i class="ion-ios7-information-outline"></i> <span> Slider </span></a></li>
                        <!-- <li><a href="{{ route('admin.about.index') }}" class="waves-effect"><i class="ion-ios7-information-outline"></i> <span> من نحن </span></a></li> -->
                        <li><a href="{{ route('admin.setting.index') }}" class="waves-effect"><i class="ion-ios7-information-outline"></i> <span> Setting </span></a></li>
                        <!-- <li><a href="{{ route('admin.coupon.index') }}" class="waves-effect"><i class="ion-ios7-information-outline"></i> <span> الكوبونات </span></a></li> -->
                        <li><a href="{{ route('admin.paymentmethod.index') }}" class="waves-effect"><i class="ion-ios7-information-outline"></i> <span> Payment Method </span></a></li>
                        <!-- <li><a href="{{ route('admin.delivertime.index') }}" class="waves-effect"><i class="ion-ios7-information-outline"></i> <span> أوقات التوصيل </span></a></li> -->
                        <!-- <li><a href="{{ route('admin.smsreminder.index') }}" class="waves-effect"><i class="ion-ios7-information-outline"></i> <span> تذكيرات الرسائل </span></a></li> -->
                        <li><a href="{{ route('admin.contact.index') }}" class="waves-effect"><i class="ion-ios7-information-outline"></i> <span> Contacts </span></a></li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class=" dripicons-view-list"></i>
                                <span> Admins and roles </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{ route('admin.category.index') }}" class="waves-effect"><span> الادوار </span></a></li>
                                <li><a href="{{ route('admin.category.index') }}" class="waves-effect"> <span>المسئوليين </span></a></li>
                            </ul>
                        </li>
                    </ul>

                    <div class="clearfix"></div>

                </div>

                <div class="clearfix"></div>

            </div>

        </div>

        <!-- Left Sidebar End -->

    </div>

    <!-- END wrapper -->

    <script>
        var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <script src="{{ asset('admin_assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/popper.min.js') }}"></script><!-- Popper for Bootstrap -->
    <script src="{{ asset('admin_assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/detect.js') }}"></script>
    <script src="{{ asset('admin_assets/js/fastclick.js') }}"></script>
    <script src="{{ asset('admin_assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('admin_assets/js/jquery.blockUI.js') }}"></script>
    <script src="{{ asset('admin_assets/js/waves.js') }}"></script>
    <script src="{{ asset('admin_assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('admin_assets/js/jquery.scrollTo.min.js') }}"></script>

    <!--Morris Chart-->
    <script src="{{ asset('admin_assets/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/raphael/raphael-min.js') }}"></script>
    {{-- <script src="{{asset('admin_assets/pages/morris.init.js')}}"></script> --}}



    <!-- jQuery  -->

    <script src="{{ asset('admin_assets/plugins/moment/moment.js') }}"></script>

    <script src="{{ asset('admin_assets/plugins/bootstrap-sweetalert/sweet-alert.min.js') }}"></script>

    <script src="{{ asset('admin_assets/plugins/dropzone/dropzone.js') }}"></script>

    <script src="{{ asset('admin_assets/plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('admin_assets/plugins/bootstrap-table/js/bootstrap-table.js') }}"></script>
    <script src="{{ asset('admin_assets/pages/jquery.bs-table.js') }}"></script>
    <!-- Modal-Effect -->
    <script src="{{ asset('admin_assets/plugins/custombox/js/custombox.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/custombox/js/legacy.min.js') }}"></script>

    <!-- chatjs  -->

    <script src="{{ asset('admin_assets/pages/jquery.chat.js') }}"></script>

    <script src="{{ asset('admin_assets/plugins/peity/jquery.peity.min.js') }}"></script>

    <script src="{{ asset('admin_assets/pages/jquery.dashboard_2.js') }}"></script>

    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script src="{{ asset('admin_assets/plugins/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/switchery/js/switchery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin_assets/plugins/multiselect/js/jquery.multi-select.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('admin_assets/plugins/jquery-quicksearch/jquery.quicksearch.js') }}">
    </script>
    <script src="{{ asset('admin_assets/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('admin_assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('admin_assets/pages/jquery.form-advanced.init.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/owl.carousel/dist/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('admin_assets/js/jquery.core.js') }}"></script>
    <script src="{{ asset('admin_assets/js/jquery.app.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            if ($("#content").length > 0) {
                tinymce.init({
                    selector: "textarea#content",
                    theme: "modern",
                    height: 300,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker", "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking", "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
                    style_formats: [{
                        title: 'Bold text',
                        inline: 'b'
                    }, {
                        title: 'Red text',
                        inline: 'span',
                        styles: {
                            color: '#ff0000'
                        }
                    }, {
                        title: 'Red header',
                        block: 'h1',
                        styles: {
                            color: '#ff0000'
                        }
                    }, {
                        title: 'Example 1',
                        inline: 'span',
                        classes: 'example1'
                    }, {
                        title: 'Example 2',
                        inline: 'span',
                        classes: 'example2'
                    }, {
                        title: 'Table styles'
                    }, {
                        title: 'Table row 1',
                        selector: 'tr',
                        classes: 'tablerow1'
                    }]
                });
            }

            if ($("#content2").length > 0) {
                tinymce.init({
                    selector: "textarea#content2",
                    theme: "modern",
                    height: 300,
                    directionality: "rtl",
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker", "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking", "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
                    style_formats: [{
                        title: 'Bold text',
                        inline: 'b'
                    }, {
                        title: 'Red text',
                        inline: 'span',
                        styles: {
                            color: '#ff0000'
                        }
                    }, {
                        title: 'Red header',
                        block: 'h1',
                        styles: {
                            color: '#ff0000'
                        }
                    }, {
                        title: 'Example 1',
                        inline: 'span',
                        classes: 'example1'
                    }, {
                        title: 'Example 2',
                        inline: 'span',
                        classes: 'example2'
                    }, {
                        title: 'Table styles'
                    }, {
                        title: 'Table row 1',
                        selector: 'tr',
                        classes: 'tablerow1'
                    }]
                });
            }

            //owl carousel
            $("#owl-slider").owlCarousel({
                loop: true,
                nav: false,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplayHoverPause: true,
                animateOut: 'fadeOut',
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            });
        });
    </script>

    @yield('scripts')

</body>

</html>
