<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>

    <link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet">
    <!-- CSS STYLE-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/plagin/zoom/css/xzoom.css')}}" media="all" />

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{asset('frontend/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('frontend/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{url('frontend/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('frontend/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('frontend/images/ico/apple-touch-icon-57-precomposed.png')}}">
    <link rel="stylesheet" href="{{asset('frontend/starRating/StarRating.css')}}">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">


    {{--Custom style--}}
    <link href="{{asset('frontend/css/price-range.css')}}" rel="stylesheet"> {{--for slider  range--}}
    <link href="{{asset('frontend/css/custom_style.css')}}" rel="stylesheet">



</head><!--/head-->

<body>
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{url('/')}}"><img src="{{URL::to('frontend/images/home/logo.png')}}" alt="" /></a>
                    </div>

                </div>
                <div class="col-sm-8">
                    <div class="mainmenu pull-right">
                        <ul class="nav navbar-nav collapse navbar-collapse">



                            {{-- {{$current_route = Route::getFacadeRoot()->current()->uri() }}--}}
                            <?php
                            $url= Request::path();
                            /*dd(url()->previous());*/
                            /*$all =  url()->current()*/
                            ?>
                            <li><a class="<?php if($url == "/"){echo 'active';}?>" href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
                            <li><a class="<?php if($url == "wishlist.index"){echo 'active';}?>" href="{{url('wishlist.index')}}"><i class="fa fa-star"></i> Wishlist <sup>{{count(Cart::instance('wishlist')->content())}}</sup></a></li>
                            @if(Auth::user())
                                <li><a class="<?php if($url == "checkout"){echo 'active';}?>" href="{{URL::to('checkout')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                            @else
                                <li><a href="{{URL::to('login')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                            @endif
                            <li><a class="<?php if($url == "show-cart"){echo 'active';}?>" href="{{route('cart.index')}}"><i class="fa fa-shopping-cart"></i> Cart <sup class="text-danger">{{count(Cart::instance('cart')->content())}}</sup></a></li>
                            <?php $customer_id = Session::get('customer_id')?>
                            <li><a class="{{ (request()->is('contact-us*')) ? 'active' : '' }}" href="{{URL::to('contact-us')}}">Contact</a></li>
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}"><i class="fa fa-lock"></i> {{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="dropdown"><a href="#"><i class="fa fa-user"></i> Account<i class="fa fa-angle-down"></i> </a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="{{url('user-profile')}}">Profile</a></li>
                                        <li>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>
                                            </form></li>
                                    </ul>
                                </li>
                            @endguest

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->
