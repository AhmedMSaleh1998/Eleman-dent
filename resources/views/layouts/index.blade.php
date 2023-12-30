<!DOCTYPE html>
<html class="desktop mbr-site-loaded">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="generator" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/png" href="{{asset('front_assets/en/img/logo.PNG')}}">   
    <meta name="description" content="" />
    <title>Alex supplies</title>
    <link rel="stylesheet" href="{{asset('front_assets/en/css/bootstrap.min.css')}}" />
    @if(App::isLocale('ar'))
        <link rel="stylesheet" href="{{asset('front_assets/ar/css/home-ar.css')}}" />
    @else
        <link rel="stylesheet" href="{{asset('front_assets/en/css/theme1.css')}}" />
    @endif
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css">   
    <link rel="stylesheet" href="{{asset('front_assets/en/css/animate.css')}}" />  
    <link rel="stylesheet" href="{{asset('front_assets/en/css/hover.css')}}" />
    @yield('styles')
</head>
<body>
<!--------start navbar-------------->  
<header>      
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{route('/')}}"><img src="{{asset('front_assets/en/img/logo.png')}}" width="60%"></a>     
            <button class="navbar-toggler float-left" type="button" data-toggle="collapse" data-target="#navbar10">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </button>
            <div class="navbar-collapse collapse" id="navbar10">
                 <ul class="navbar-nav mlr-auto">
                    <li class="nav-item active"><a class="nav-link hvrcenter" href="{{route('/')}}">@lang('message.Home')</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('about-us')}}">ِِ@lang('message.About') @lang('message.Us')</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @lang('message.Product')
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @if(isset($all_cats) && $all_cats !== null)
                                @foreach($all_cats as $all_cat)
                                    <a class="dropdown-item" href="{{route('our-category',[str_replace(' ','_',$all_cat->title()),$all_cat->id])}}">{{$all_cat->title()}}</a>
                                @endforeach
                            @endif
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{route('our-blog')}}">@lang('message.Blog')</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('contact-us')}}">@lang('message.Contact') @lang('message.Us')</a></li> 
                    @if(Auth::check())
                        @if(Auth::user()->is_admin == 0)
                            <li class="nav-item"><a class="nav-link" href="{{route('member.account')}}">@lang('message.My') @lang('message.Account')</a></li> 
                        @endif
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{route('member.login')}}">@lang('message.Login')</a></li>  
                    @endif
                    <li class="nav-item">
                        @if(App::isLocale('ar'))
                            <a class="nav-link" href="{{url('setlang/en')}}">English</a>
                        @else
                            <a class="nav-link" href="{{url('setlang/ar')}}">عربي</a>
                        @endif    
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>      
<!--------end navbar-------------->

@yield('content')

<!-- Footer -->
<section id="footer" class=" ">
    <div class="col-md-12 img-ff p-0">
        <img  class="img-banner" width="100%" src="{{asset('front_assets/en/img/back-footer.png')}}">
    </div>
    <div class="container text-center footer">
        <div class="row text-center text-xs-center text-sm-left text-md-left">
            <div class="col-12">
                <img class="img-footer" src="{{asset('front_assets/en/img/logo.png')}}">
            </div>
            <div class="col-12">
                <ul class="list-unstyled quick-links">
                    <li><a href="{{route('/')}}"><i class="fa fa-angle-double-right"></i>@lang('message.Home')</a></li>
                    <li><a href="{{route('about-us')}}"><i class="fa fa-angle-double-right"></i>@lang('message.About') @lang('message.Us')</a></li>
                    <li><a href="{{route('our-blog')}}"><i class="fa fa-angle-double-right"></i>@lang('message.Blog')</a></li>
                    <li><a href="{{route('contact-us')}}"><i class="fa fa-angle-double-right"></i>@lang('message.Contact') @lang('message.Us')</a></li>
                    <li>
                        @if(App::isLocale('ar'))
                            <a href="{{url('setlang/en')}}"><i class="fa fa-angle-double-right"></i>English</a>
                        @else
                            <a href="{{url('setlang/ar')}}"><i class="fa fa-angle-double-right"></i>عربي</a>
                        @endif
                    </li> 
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <ul class="list-unstyled list-inline social text-center">
                    @if(isset($setting->facebook) && $setting->facebook != null)<li class="list-inline-item"><a href="{{$setting->facebook}}" target="_blank"><i class="fab fa-facebook"></i></a></li>@endif
                    @if(isset($setting->youtube) && $setting->youtube != null)<li class="list-inline-item"><a href="{{$setting->youtube}}" target="_blank"><i class="fab fa-youtube"></i></a></li>@endif
                    @if(isset($setting->linkedin) && $setting->linkedin != null)<li class="list-inline-item"><a href="{{$setting->linkedin}}" target="_blank"><i class="fab fa-linkedin"></i></a></li>@endif
                    @if(isset($setting->twitter) && $setting->twitter != null)<li class="list-inline-item"><a href="{{$setting->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a></li>@endif
                    @if(isset($setting->instagram) && $setting->instagram != null)<li class="list-inline-item"><a href="{{$setting->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a></li>@endif
                    @if(isset($setting->whatsapp) && $setting->whatsapp != null)<li class="list-inline-item"><a href="https://wa.me/{{$setting->whatsapp}}"><i class="fab fa-whatsapp"></i></a></li>@endif
                </ul>
            </div>
            <hr>
        </div>	
            
    </div>
    <div class="border">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
                    <p class="h6">© All right Reversed.<a class="text-green ml-2" href="https://www.otextech.net" target="_blank">OTEX Technology</a></p>
                </div>
                <hr>
            </div>
        </div>
    </div>
</section>
<!-- ./Footer -->      
<!--------start js-------------->      
<script src="{{asset('front_assets/en/js/jquery-1.11.3.min.js')}}"></script>
<script src="{{asset('front_assets/en/js/bootstrap.min.js')}}"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="{{asset('front_assets/en/js/plugin.js')}}"></script> 
<script src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>  
<script src="{{asset('front_assets/en/js/wow.min.js')}}"></script>
<script>
new WOW().init();
</script>

@yield('scripts')

<!--------end js-------------->     
</body>
</html>
