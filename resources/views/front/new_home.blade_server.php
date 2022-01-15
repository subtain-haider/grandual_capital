<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>GRANDEUR CAPITAL</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{url('/')}}/front_assets/img/fv.png" type="image/x-icon">

    <link rel="stylesheet" href="{{url('/')}}/front_assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{url('/')}}/front_assets/css/fontawesome-all.css">

    <link rel="stylesheet" href="{{url('/')}}/front_assets/font-4/flaticon.css">

    <link rel="stylesheet" href="{{url('/')}}/front_assets/css/animate.css">

    <link rel="stylesheet" href="{{url('/')}}/front_assets/css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="{{url('/')}}/front_assets/css/jquery.mCustomScrollbar.min.css">

    <link rel="stylesheet" href="{{url('/')}}/front_assets/css/odometer-theme-default.css">

    <link rel="stylesheet" href="{{url('/')}}/front_assets/css/owl.carousel.css">

    <link rel="stylesheet" href="{{url('/')}}/front_assets/css/style.css">

    <link rel="stylesheet" href="{{url('/')}}/front_assets/css/software.css">

    @php

        $user = \Illuminate\Support\Facades\Auth::user();

    @endphp

    <style>

        @import url("https://fonts.googleapis.com/css?family=Lato");

        body {

            padding-top: 70px;

        }



        #pricing-tables {

            background-color: #eeeeee;

            padding: 30px 0;

            position: relative;

            font-family: "Lato", sans-serif;

        }

        #pricing-tables .col-md-3, #pricing-tables .col-sm-6, #pricing-tables .col-xs-12 {

            padding-right: 0;

            padding-left: 0;

        }

        #pricing-tables .col-md-3:hover, #pricing-tables .col-sm-6:hover, #pricing-tables .col-xs-12:hover {

            box-shadow: 0px 11px 30px 0px rgba(0, 0, 0, 0.75);

            z-index: 2;

            transform: scale(1.06);

            border: 0;

            transition: 0.5s all;

            border: none;

        }



        .single-table {

            background: #fff;

            transition: all 0.2s linear;

            z-index: 1;

            /* Bubble Float Right */

        }

        .single-table .plan-header {

            background: #e67e22;

            color: #fff;

            text-transform: capitalize;

            padding: 2px 0;

        }

        .single-table .plan-header h3 {

            margin: 0;

            padding: 20px 0 5px 0;

            text-transform: uppercase;

        }

        .single-table .plan-price {

            display: inline-block;

            color: #e67e22;

            margin: 0 0 10px 0;

            font-size: 25px;

            font-weight: bold;

            background: #fff;

            border-radius: 50%;

            color: #e67e22;

            padding: 33px 15px;

        }

        .single-table .plan-price span {

            font-size: 14px;

            font-weight: normal;

        }

        .single-table ul {

            margin: 0;

            padding: 20px 0;

            list-style: none;

        }

        .single-table ul li {

            padding: 8px 0;

            margin: 0 20px;

            border-bottom: 1px solid white;

            font-size: 15px;

        }

        .single-table .plan-submit {

            display: inline-block;

            text-decoration: none;

            margin: 20px 0 30px 0;

            padding: 10px 40px;

            border: 1px solid #e67e22;

            color: #e67e22;

            font-size: 15px;

            text-transform: uppercase;

            border-radius: 3px;

            transition: all 0.25s linear;

        }

        .single-table .plan-submit:hover {

            background: #e67e22;

            color: #FFF;

            transition: all 0.25s linear;

        }

        .single-table .hvr-bubble-float-right {

            display: inline-block;

            vertical-align: middle;

            transform: translateZ(0);

            box-shadow: 0 0 1px rgba(0, 0, 0, 0);

            -webkit-backface-visibility: hidden;

            backface-visibility: hidden;

            -moz-osx-font-smoothing: grayscale;

            position: relative;

            transition-duration: 0.3s;

            transition-property: transform;

        }

        .single-table .hvr-bubble-float-right:before {

            position: absolute;

            z-index: -1;

            top: calc(50% - 10px);

            right: 0;

            content: "";

            border-style: solid;

            border-width: 10px 0 10px 10px;

            border-color: transparent transparent transparent transparent;

            transition-duration: 0.3s;

            transition-property: transform;

        }

        .single-table .hvr-bubble-float-right:hover,

        .single-table .hvr-bubble-float-right:focus,

        .single-table .hvr-bubble-float-right:active {

            transform: translateX(-10px);

        }

        .single-table .hvr-bubble-float-right:hover:before,

        .single-table .hvr-bubble-float-right:focus:before,

        .single-table .hvr-bubble-float-right:active:before {

            transform: translateX(10px);

            border-color: transparent transparent transparent #e67e22;

        }



        .color-2 .single-table .plan-header {

            background: #3498db;

            color: #fff;

        }

        .color-2 .single-table .plan-header .plan-price {

            color: #3498db;

            background: #fff;

        }

        .color-2 .single-table .plan-submit {

            border: 1px solid #3498db;

            color: #3498db;

        }

        .color-2 .single-table .plan-submit:hover {

            background: #3498db;

            color: #FFF;

        }

        .color-2 .hvr-bubble-float-right:hover:before,

        .color-2 .hvr-bubble-float-right:focus:before,

        .color-2 .hvr-bubble-float-right:active:before {

            transform: translateX(10px);

            border-color: transparent transparent transparent #3498db;

        }



        .color-3 .single-table .plan-header {

            background: #2ecc71;

            color: #fff;

        }

        .color-3 .single-table .plan-header .plan-price {

            color: #2ecc71;

            background: #fff;

        }

        .color-3 .single-table .plan-submit {

            border: 1px solid #2ecc71;

            color: #2ecc71;

        }

        .color-3 .single-table .plan-submit:hover {

            background: #2ecc71;

            color: #FFF;

        }

        .color-3 .hvr-bubble-float-right:hover:before,

        .color-3 .hvr-bubble-float-right:focus:before,

        .color-3 .hvr-bubble-float-right:active:before {

            transform: translateX(10px);

            border-color: transparent transparent transparent #2ecc71;

        }



        .color-4 .single-table .plan-header {

            background: #9b59b6;

            color: #fff;

        }

        .color-4 .single-table .plan-header .plan-price {

            color: #9b59b6;

            background: #fff;

        }

        .color-4 .single-table .plan-submit {

            border: 1px solid #9b59b6;

            color: #9b59b6;

        }

        .color-4 .single-table .plan-submit:hover {

            background: #9b59b6;

            color: #FFF;

        }

        .color-4 .hvr-bubble-float-right:hover:before,

        .color-4 .hvr-bubble-float-right:focus:before,

        .color-4 .hvr-bubble-float-right:active:before {

            transform: translateX(10px);

            border-color: transparent transparent transparent #9b59b6;

        }

        .card {

            border: none

        }



        .user-content p {

            margin-top: 5px;

            font-size: 12px

        }



        .ratings i {

            color: blue

        }

    </style>

</head>

<body class="soft-m-home" data-spy="scroll" data-target=".soft-m-main-navigation" data-offset="80">

<!-- preloader - start -->

{{--<div id="soft-m-preloader"></div>--}}

<div class="up">

    <a href="#" class="soft-m-scrollup text-center"><i class="fas fa-arrow-up"></i></a>

</div>

<!-- Start of header section

    ============================================= -->

<header id="soft-m-header" class="soft-m-main-header">

    <div class="container">

        <div class="soft-m-main-header-content position-relative clearfix">

            <div class="soft-m-logo float-left">

                <a class="soft-m-logo-1" href="#"><img src="{{url('/')}}/front_assets/img/soft/logo/logo1.png" width="80" height="40" alt=""></a>

            </div>

{{--            <div class="soft-m-language">--}}

{{--                <select>--}}

{{--                    <option value="#">Eng</option>--}}

{{--                    <option value="#">ESP</option>--}}

{{--                    <option value="#">ARB</option>--}}

{{--                </select>--}}

{{--            </div>--}}

            <div class="soft-m-main-menu-item float-right">

                <nav class="soft-m-main-navigation float-left clearfix ul-li">

                    <ul id="main-nav" class="navbar-nav text-capitalize clearfix">

                        <li><a class="nav-link" href="#soft-m-banner">Home</a> </li>

                        <li><a class="nav-link" href="#soft-m-feature">Features</a> </li>

                        <li><a class="nav-link" href="#soft-m-feature-process">Process</a></li>

                        <li><a class="nav-link" href="#soft-m-intregration">Intregration </a></li>

                        <li><a class="nav-link" href="#pricing-tables">Prices</a></li>

                        <li><a class="nav-link" target="_blank" href="/forums">Forums</a> </li>

                        @if(empty($user))

                        <li><a class="nav-link" target="_blank" href="/login">Login</a> </li>

                        <li><a class="nav-link" target="_blank" href="/register">Register</a> </li>

                        @else

                            <li><a class="nav-link"

                                   @if($user->is_admin)

                                   href="/admin/home"

                                   @else

                                   href="/user/dashboard"

                                        @endif

                                >Dashboard</a> </li>

                            <li>

                                <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link" >Logout</a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">{{ csrf_field() }} </form>

                            </li>

                        @endif

                    </ul>

                </nav>

{{--                <div class="soft-m-side-bar-toggle soft-m-side-toggle-btn float-right">--}}

{{--                    <i class="flaticon-menu"></i>--}}

{{--                </div>--}}

                <div class="soft-m-header-btn text-center text-capitalize soft-m-side-toggle-btn float-right">

                    <a href="#">About Us</a>

                </div>

            </div>

            <div class="soft-m-sidebar-inner">

                <div class="side_overlay soft-m-side-toggle-btn"></div>

                <div class="sm-side_inner_content">

                    <div class="close_btn soft-m-side-toggle-btn"><i class="flaticon-letter-x"></i></div>

                    <div class="side_inner_logo">

                        <a href="!#"><img src="{{url('/')}}/front_assets/img/soft/logo/logo1.png" width="145" height="40" alt=""></a>

                    </div>

                    <p>

                        Mission Statement: GRANDEUR CAPITAL is what a NOIVCE Trader has searched for and where FULL-TIME traders our born. We at GC have built a community by TRADERS for TRADERS. We have partnered with Major Leaders/Brands in the FOREIGN EXCHANGE, STOCK, and BINARY OPTIONS Markets. Our products have been tested by the BEST in the MARKET, used DAILY by all OWNERS of GRANDUER, and have proof to BACK IT UP (Click here for product results). Our main OBJECTIVE is to provide you a safe community for TRADERS to COMMUNICATE, LEARN, and most importantly EARN!

                    </p>

                    <div class="side_contact">

{{--                        <div class="soft-m-sidebar-gallary clearfix ul-li">--}}

{{--                            <h3> Our Gallery</h3>--}}

{{--                            <ul>--}}

{{--                                <li><a href="#"><img src="{{url('/')}}/front_assets/img/soft/blog/br1.jpg" alt=""></a></li>--}}

{{--                                <li><a href="#"><img src="{{url('/')}}/front_assets/img/soft/blog/br1.jpg" alt=""></a></li>--}}

{{--                                <li><a href="#"><img src="{{url('/')}}/front_assets/img/soft/blog/br1.jpg" alt=""></a></li>--}}

{{--                                <li><a href="#"><img src="{{url('/')}}/front_assets/img/soft/blog/br1.jpg" alt=""></a></li>--}}

{{--                                <li><a href="#"><img src="{{url('/')}}/front_assets/img/soft/blog/br1.jpg" alt=""></a></li>--}}

{{--                                <li><a href="#"><img src="{{url('/')}}/front_assets/img/soft/blog/br1.jpg" alt=""></a></li>--}}

{{--                                <li><a href="#"><img src="{{url('/')}}/front_assets/img/soft/blog/br1.jpg" alt=""></a></li>--}}

{{--                                <li><a href="#"><img src="{{url('/')}}/front_assets/img/soft/blog/br1.jpg" alt=""></a></li>--}}

{{--                                <li><a href="#"><img src="{{url('/')}}/front_assets/img/soft/blog/br1.jpg" alt=""></a></li>--}}

{{--                            </ul>--}}

{{--                        </div>--}}

                        <div class="social_widget ul-li soft-m-headline relative-position">

                            <h3> Follow Us On:</h3>

                            <ul>

                                <li class="h-fb"><a href="#"><i class="fab fa-facebook-f"></i></a></li>

                                <li class="h-tw"><a href="#"><i class="fab fa-twitter"></i></a></li>

                                <li class="h-bh"><a href="#"><i class="fab fa-behance"></i></a></li>

                                <li class="h-yo"><a href="#"><i class="fab fa-youtube"></i></a></li>

                            </ul>

                        </div>

                        <div class="side_copywright text-center">

                           <b> <a target="_blank" href="http://maxbitz.com/"></a> </b>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- /desktop menu -->

        <div class="soft-m-mobile_menu position-relative">

            <div class="soft-m-mobile_menu_button soft-m-open_mobile_menu">

                <i class="fas fa-bars"></i>

            </div>

            <div class="soft-m-mobile_menu_wrap">

                <div class="mobile_menu_overlay soft-m-open_mobile_menu"></div>

                <div class="soft-m-mobile_menu_content">

                    <div class="soft-m-mobile_menu_close soft-m-open_mobile_menu">

                        <i class="flaticon-letter-x"></i>

                    </div>

                    <div class="m-brand-logo text-center">

                        <a href="!#"><img src="{{url('/')}}/front_assets/img/soft/logo/logo1.png" width="145" height="40" alt=""></a>

                    </div>

                    <nav class="soft-m-mobile-main-navigation  clearfix ul-li">

                        <ul id="m-main-nav" class="navbar-nav text-capitalize clearfix">

                            <li><a class="nav-link" href="#soft-m-banner">Home</a> </li>

                            <li><a class="nav-link" href="#soft-m-feature">Features</a> </li>

                            <li><a class="nav-link" href="#soft-m-feature-process">Process</a></li>

                            <li><a class="nav-link" href="#soft-m-intregration">Intregration </a></li>

                            <li><a class="nav-link" href="#soft-m-platform">Platform</a></li>

                            <li><a class="nav-link" href="#soft-m-blog">Blog</a> </li>

                        </ul>

                    </nav>

                </div>

            </div>

            <!-- /Mobile-Menu -->

        </div>

    </div>

</header>

<!-- End of header section

    ============================================= -->



<!-- Start of banner section

    ============================================= -->

<section id="soft-m-banner" class="soft-m-banner-section" data-background="{{url('/')}}/front_assets/img/soft/screen/b-bg.png">

    <div class="container">

        <div class="soft-m-banner-content soft-m-headline">

            <h1>WE ARE GRANDEUR CAPITAL</h1>

            <span></span>

{{--            <div class="soft-m-banner-subscribe-form">--}}

{{--                <form action="#">--}}

{{--                    <div class="soft-m-subs position-relative">--}}

{{--                        <input type="email" name="email" placeholder="Enter email address.">--}}

{{--                    </div>--}}

{{--                    <button>Get Started Now</button>--}}

{{--                    <div class="soft-m-moto">--}}

{{--                        <span>Free Forever</span>--}}

{{--                        <span>No Credit Card</span>--}}

{{--                    </div>--}}

{{--                </form>--}}

{{--            </div>--}}

        </div>

    </div>

</section>

<!-- End of banner section

    ============================================= -->

  <!-- start of new count section

    ============================================= -->

    <section style="padding: 15px">
        <div class="container">
            <div class="row">
                <br/>
    <!--{{--            <div class="col text-center">--}}-->
    <!--{{--                <h2>Bootstrap 4 counter</h2>--}}-->
    <!--{{--                <p>counter to count up to a target number</p>--}}-->
    <!--{{--            </div>--}}-->



            </div>
            <div class="row text-center">
                <div class="col">
                    <div class="counter">
                        <div class="soft-m-inner-icon" style="filter: drop-shadow(0px 1px 4px rgba(0, 0, 0, 0.1));">
                            <div class="soft-m-feature-icon text-center" style="width: 85px;  margin: auto; height: 95px; line-height: 100px; background-color: #fff; position: relative;  z-index: 1;  -webkit-clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%); clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);">
                            <i class="fa fa-coffee fa-2x" style="background: linear-gradient(90deg, #102465 0%, #00acf0 100%);  -webkit-background-clip: text;
                            -webkit-text-fill-color: transparent;"></i>
                            </div>
                        </div>
                        
                        <h2 class="timer count-title count-number pt-2" style="color: #102465;" data-to="1700" data-speed="1500">1700</h2>
                        <p class="count-text " style=" color: #1970cc;">Users</p>
                    </div>
                </div>
                <div class="col">
                    <div class="counter">
                        <div class="soft-m-inner-icon" style="filter: drop-shadow(0px 1px 4px rgba(0, 0, 0, 0.1));">
                            <div class="soft-m-feature-icon text-center" style="width: 85px;  margin: auto; height: 95px; line-height: 100px; background-color: #fff; position: relative;  z-index: 1;  -webkit-clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%); clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);">
                            <i class="fa fa-code fa-2x" style="background: linear-gradient(90deg, #102465 0%, #00acf0 100%);  -webkit-background-clip: text;
                            -webkit-text-fill-color: transparent;"></i>
                            </div>
                        </div>
                        <h2 class="timer count-title count-number pt-2" style="color: #102465;" data-to="1700" data-speed="1500">100</h2>
                        <p class="count-text " style=" color: #1970cc;">Download</p>
                    </div>
                </div>
                <div class="col">
                    <div class="counter">
                        <div class="soft-m-inner-icon" style="filter: drop-shadow(0px 1px 4px rgba(0, 0, 0, 0.1));">
                            <div class="soft-m-feature-icon text-center" style="width: 85px;  margin: auto; height: 95px; line-height: 100px; background-color: #fff; position: relative;  z-index: 1;  -webkit-clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%); clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);">
                            <i class="far fa-lightbulb fa-2x"  style="background: linear-gradient(90deg, #102465 0%, #00acf0 100%);  -webkit-background-clip: text;
                            -webkit-text-fill-color: transparent;"></i>
                            </div>
                        </div>
                        <h2 class="timer count-title count-number pt-2" style="color: #102465;" data-to="1700" data-speed="1500">11,900</h2>
                        <p class="count-text " style=" color: #1970cc;">Likes</p>
                    </div></div>
                <div class="col">
                    <div class="counter">
                        <div class="soft-m-inner-icon" style="filter: drop-shadow(0px 1px 4px rgba(0, 0, 0, 0.1));">
                            <div class="soft-m-feature-icon text-center" style="width: 85px;  margin: auto; height: 95px; line-height: 100px; background-color: #fff; position: relative;  z-index: 1;  -webkit-clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%); clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);">
                            <i class="fa fa-bug fa-2x" style="background: linear-gradient(90deg, #102465 0%, #00acf0 100%);  -webkit-background-clip: text;
                            -webkit-text-fill-color: transparent;"></i>
                            </div>
                        </div>
                        <h2 class="timer count-title count-number pt-2" style="color: #102465;" data-to="1700" data-speed="1500">157</h2>
                        <p class="count-text " style=" color: #1970cc;">5 star Rating</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- End of new count section

    ============================================= -->

<!-- Start of Feature section

    ============================================= -->

<section id="soft-m-feature" class="soft-m-feature-section">

    <div class="container">

        <div class="soft-m-section-title text-center soft-m-headline">

            <span>Key Features</span>

            <h2>Why Join Grandeur Capital</h2>

        </div>

        <div class="soft-m-feature-content">

            <div class="row justify-content-center">

                <div class="col-lg-4 col-md-6">

                    <div class="soft-m-feature-inner position-relative wow fadeFromUp" data-wow-delay="0ms" data-wow-duration="1500ms">

                        <div class="soft-m-inner-icon">

                            <div class="soft-m-feature-icon text-center">

                                <i class="far fa-comments"></i>

                            </div>

                        </div>

                        <div class="soft-m-feature-box">

                            <div class="soft-m-feature-text soft-m-headline pera-content">

                                <h3><a href="#">Affiliate Program</a></h3>

                                <p>If you enjoy our products and services, invite your network to us for a monthly residual income based on each client you introduce GC to .</p>

                                <a class="soft-f-more" href="#">Read More</a>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4 col-md-6">

                    <div class="soft-m-feature-inner position-relative wow fadeFromUp" data-wow-delay="100ms" data-wow-duration="1500ms">

                        <div class="soft-m-inner-icon">

                            <div class="soft-m-feature-icon text-center">

                                <i class="fas fa-box"></i>

                            </div>

                        </div>

                        <div class="soft-m-feature-box">

                            <div class="soft-m-feature-text soft-m-headline pera-content">

                                <h3><a href="#">Low Monthly cost </a></h3>

                                <p>Our goal is to provide you with tools at a reasonable rate. If you are not profiting MORE, then we CHARGE then we have failed you. Click here to see results of some of our PASSIVE products (EXPERT ADVISORS): insert link to MYFXBOOK’s over the EAs on the products that we are currently posting on the website and any indictor results from the beta group and back tests </p>

                                <a class="soft-f-more" href="#">Read More</a>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4 col-md-6">

                    <div class="soft-m-feature-inner position-relative wow fadeFromUp" data-wow-delay="200ms" data-wow-duration="1500ms">

                        <div class="soft-m-inner-icon">

                            <div class="soft-m-feature-icon text-center">

                                <i class="fas fa-users"></i>

                            </div>

                        </div>

                        <div class="soft-m-feature-box">

                            <div class="soft-m-feature-text soft-m-headline pera-content">

                                <h3><a href="#">Custom Indicator Library</a></h3>

                                <p>This indicator library will be jammed packed with over 50 verified and back tested indicators. Once you lock arms with GC, there will not be ANY reason you can’t be become a successful trader </p>

                                <a class="soft-f-more" href="#">Read More</a>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4 col-md-6">

                    <div class="soft-m-feature-inner position-relative wow fadeFromUp" data-wow-delay="300ms" data-wow-duration="1500ms">

                        <div class="soft-m-inner-icon">

                            <div class="soft-m-feature-icon text-center">

                                <i class="fab fa-staylinked"></i>

                            </div>

                        </div>

                        <div class="soft-m-feature-box">

                            <div class="soft-m-feature-text soft-m-headline pera-content">

                                <h3><a href="#">Seamless Onboarding</a></h3>

                                <p>Once checked out you will be provided with a simple step-by-step video/instructional guide to be setup quickly</p>

                                <a class="soft-f-more" href="#">Read More</a>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4 col-md-6">

                    <div class="soft-m-feature-inner position-relative wow fadeFromUp" data-wow-delay="400ms" data-wow-duration="1500ms">

                        <div class="soft-m-inner-icon">

                            <div class="soft-m-feature-icon text-center">

                                <i class="far fa-clock"></i>

                            </div>

                        </div>

                        <div class="soft-m-feature-box">

                            <div class="soft-m-feature-text soft-m-headline pera-content">

                                <h3><a href="#">Refund Policy</a></h3>

                                <p>We are NOT here to take your money; we are here to help you MAKE it. That said all our packages are backed with a 7-day MONEY BACK GUARANTEE. After the 7-day window, all sales are final NO REFUNDS</p>

                                <a class="soft-f-more" href="#">Read More</a>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4 col-md-6">

                    <div class="soft-m-feature-inner position-relative wow fadeFromUp" data-wow-delay="500ms" data-wow-duration="1500ms">

                        <div class="soft-m-inner-icon">

                            <div class="soft-m-feature-icon text-center">

                                <i class="far fa-bell"></i>

                            </div>

                        </div>

                        <div class="soft-m-feature-box">

                            <div class="soft-m-feature-text soft-m-headline pera-content">

                                <h3>Trade with Market Makers Concepts</h3>

                                <p>Build ClickUp into virtually anything imaginable with details that matter to you.</p>

                                <a class="soft-f-more" href="#">Read More</a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- End of Feature section

    ============================================= -->



<!-- Start of backers section

    ============================================= -->

{{--<section id="soft-m-partner" class="soft-m-partner-section">--}}

{{--    <div class="container">--}}

{{--        <div class="soft-m-section-title text-center soft-m-headline">--}}

{{--            <span>Our Partners</span>--}}

{{--        </div>--}}

{{--        <div class="soft-m-partner-content text-center ul-li wow fadeFromUp" data-wow-delay="0ms" data-wow-duration="1500ms">--}}

{{--            <ul>--}}

{{--                <li><a href="#"><img src="{{url('/')}}/front_assets/img/soft/partner/sfp1.png" alt=""></a></li>--}}

{{--                <li><a href="#"><img src="{{url('/')}}/front_assets/img/soft/partner/sfp2.png" alt=""></a></li>--}}

{{--                <li><a href="#"><img src="{{url('/')}}/front_assets/img/soft/partner/sfp3.png" alt=""></a></li>--}}

{{--                <li><a href="#"><img src="{{url('/')}}/front_assets/img/soft/partner/sfp4.png" alt=""></a></li>--}}

{{--                <li><a href="#"><img src="{{url('/')}}/front_assets/img/soft/partner/sfp5.png" alt=""></a></li>--}}

{{--                <li><a href="#"><img src="{{url('/')}}/front_assets/img/soft/partner/sfp6.png" alt=""></a></li>--}}

{{--                <li><a href="#"><img src="{{url('/')}}/front_assets/img/soft/partner/sfp7.png" alt=""></a></li>--}}

{{--            </ul>--}}

{{--            <div class="soft-m-partner-btn text-center">--}}

{{--                <a href="#">See Business Solution</a>--}}

{{--            </div>--}}

{{--        </div>--}}

{{--    </div>--}}

{{--</section>--}}

<!-- End of backers section

    ============================================= -->



<!-- Start of feature process section

    ============================================= -->

<section id="soft-m-feature-process" class="soft-m-feature-process-section">

    <div class="container">

        <div class="soft-m-ft-process-content">

            <div class="soft-m-ft-process-img-text">

                <div class="row">

                    <div class="col-lg-6">

                        <div class="soft-m-ft-process-img text-center wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">

                            <img src="{{url('/')}}/front_assets/img/soft/vector/ftp1.png" alt="">

                        </div>

                    </div>

                    <div class="col-lg-6">

                        <div class="soft-m-ft-process-text soft-ft-process-right-text">

                            <div class="soft-m-section-title position-relative soft-m-headline">

                                <div class="soft-ft-tag position-relative">Features One <span class="soft-ft-process-serial position-absolute"><strong>01</strong></span></div>

                                <h2>Twenty + years of collective trading experience</h2>

                            </div>

                            <div class="soft-m-feature-details">

                                GC is built off an ESTABLISED network of FULL-TIME traders. We are committed to building consistently profitable traders to join our family! The longevity of your SUCCESS is our NUMBER 1 priority

                            </div>

                        </div>

                    </div>

                </div>

                <div class="soft-m-ft-devider text-center">

                    <i class="fas fa-arrow-down"></i>

                </div>

            </div>

            <div class="soft-m-ft-process-img-text">

                <div class="row">

                    <div class="col-lg-6">

                        <div class="soft-m-ft-process-text soft-ft-process-left-text">

                            <div class="soft-m-section-title position-relative soft-m-headline">

                                <div class="soft-ft-tag position-relative">Features Two <span class="soft-ft-process-serial position-absolute"><strong>02</strong></span></div>

                                <h2>Risk Management</h2>

                            </div>

                            <div class="soft-m-feature-details">

                                GRANDEUR CAPITAL believes in practicing RISK MANAGEMENT. Following a strict set of rules always WINs in the MARKETS. Our tools are setup with multiple options to ensure YOU never over leverage, over trade, or over BLOW accounts

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-6">

                        <div class="soft-m-ft-process-img text-center wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">

                            <img src="{{url('/')}}/front_assets/img/soft/vector/ftp2.png" alt="">

                        </div>

                    </div>

                </div>

                <div class="soft-m-ft-devider text-center">

                    <i class="fas fa-arrow-down"></i>

                </div>

            </div>

            <div class="soft-m-ft-process-img-text">

                <div class="row">

                    <div class="col-lg-6">

                        <div class="soft-m-ft-process-img text-center wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">

                            <img src="{{url('/')}}/front_assets/img/soft/vector/ftp3.png" alt="">

                        </div>

                    </div>

                    <div class="col-lg-6">

                        <div class="soft-m-ft-process-text soft-ft-process-right-text">

                            <div class="soft-m-section-title position-relative soft-m-headline">

                                <div class="soft-ft-tag position-relative">Features Three <span class="soft-ft-process-serial position-absolute"><strong>03</strong></span></div>

                                <h2>Document Library</h2>

                            </div>

                            <div class="soft-m-feature-details">

                                We offer a document library with educational and training resources designed to generate new trading ideas and help you continually improve your skills.

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- End of feature process section

    ============================================= -->



<!-- Start of soft-m-newslatter section

    ============================================= -->

<section id="soft-m-newslatter" class="soft-m-newslatter-section position-relative">

    <div class="container">

        <div class="soft-m-newslatter-content position-relative">

            <div class="row">

                <div class="col-lg-6">

                    <div class="soft-m-newslatter-text soft-m-headline">

                        <h3>Want to subscribe to our results group? Insert your email to subscribe for FREE</h3>

                    </div>

                </div>

                <div class="col-lg-6">

                    <div class="soft-m-subs position-relative">

                        <form action="#" method="post">

                            <input type="email" name="email" placeholder="Enter email address.">

                            <button>Subscribe Now</button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- End of soft-m-newslatter section

    ============================================= -->



<!-- Start of intregrations section

    ============================================= -->

<section id="soft-m-intregration" class="soft-m-intregration-section">

    <div class="container">

        <div class="soft-m-section-title text-center soft-m-headline">

               <span> Intregrations

               </span>

            <h2> More reasons to STOP looking for another Company

            </h2>

        </div>

        <div class="soft-m-intregration-content">

            <div class="row justify-content-center">

                <div class="col-lg-4 col-md-6">

                    <div class="soft-m-intre-innerbox text-center wow fadeFromUp" data-wow-delay="0ms" data-wow-duration="1500ms">

                        <div class="soft-m-intre-img">

                            <img src="{{url('/')}}/front_assets/img/soft/vector/sin1.png" alt="">

                        </div>

                        <div class="soft-m-intre-text soft-m-headline pera-content">

                            <h3><a href="#">Support from the community</a></h3>

                            <p>Help when you need it the MOST. Getting in touch with GC’s highly skilled team is fast and easy, whether by email or our online Client open chat room.</p>

                            <a class="soft-in-more" href="#"><i class="fas fa-arrow-right"></i></a>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4 col-md-6">

                    <div class="soft-m-intre-innerbox text-center wow fadeFromUp" data-wow-delay="200ms" data-wow-duration="1500ms">

                        <div class="soft-m-intre-img">

                            <img src="{{url('/')}}/front_assets/img/soft/vector/sin2.png" alt="">

                        </div>

                        <div class="soft-m-intre-text soft-m-headline pera-content">

                            <h3><a href="#">PLUG & PLAY Systems</a></h3>

                            <p>Everything GC produces is ingrained with our principles. Our tools are backed by years of historical market data. This breads the confidence you need to test, enhance, and implement a winning trading strategy(s) </p>

                            <a class="soft-in-more" href="#"><i class="fas fa-arrow-right"></i></a>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4 col-md-6">

                    <div class="soft-m-intre-innerbox text-center wow fadeFromUp" data-wow-delay="400ms" data-wow-duration="1500ms">

                        <div class="soft-m-intre-img">

                            <img src="{{url('/')}}/front_assets/img/soft/vector/sin3.png" alt="">

                        </div>

                        <div class="soft-m-intre-text soft-m-headline pera-content">

                            <h3><a href="#">Proper Infrastructure</a></h3>

                            <p>We are EQUIPPED for the MARKETS, BUILT for the MARKETS, and have PROVEN SUCCESS in the MARKETS. WE ARE GRANDUER CAPITAL LLP</p>

                            <a class="soft-in-more" href="#"><i class="fas fa-arrow-right"></i></a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="soft-intre-bottom-img text-center">

        <img src="{{url('/')}}/front_assets/img/soft/vector/in-vector1.png" alt="">

    </div>

</section>

<!-- End of intregrations section

    ============================================= -->



<!-- Start of platform download section

    ============================================= -->

{{--<section id="soft-m-platform" class="soft-m-platform-section">--}}

{{--    <div class="container">--}}

{{--        <div class="soft-m-logo-icon text-center position-relative">--}}

{{--            <img src="{{url('/')}}/front_assets/img/soft/logo/l-icon.png" alt="">--}}

{{--        </div>--}}

{{--        <div class="soft-m-section-title text-center soft-m-headline">--}}

{{--            <span>Platform Download</span>--}}

{{--            <h2>Move work forward anywhere</h2>--}}

{{--        </div>--}}

{{--        <div class="soft-m-download-btn text-center">--}}

{{--            <a href="#"><img src="{{url('/')}}/front_assets/img/soft/logo/i-icon1.png" alt=""></a>--}}

{{--            <a href="#"><img src="{{url('/')}}/front_assets/img/soft/logo/g-icon1.png" alt=""></a>--}}

{{--        </div>--}}

{{--    </div>--}}

{{--    <div class="soft-m-platform-screen position-relative ul-li text-center">--}}

{{--        <ul>--}}

{{--            <li><img src="{{url('/')}}/front_assets/img/soft/screen/pts1.jpg" alt=""></li>--}}

{{--            <li><img src="{{url('/')}}/front_assets/img/soft/screen/pts2.jpg" alt=""></li>--}}

{{--            <li><img src="{{url('/')}}/front_assets/img/soft/screen/pts3.jpg" alt=""></li>--}}

{{--        </ul>--}}

{{--    </div>--}}

{{--</section>--}}

<!-- End of platform download section

    ============================================= -->

<!-- pricing table  -->

<section id="pricing-tables">

    <div class="container">

        <div class="row justify-content-center">

            @foreach($subscriptions as $subscription)

                <div class="col-md-3 col-sm-6 col-xs-12 color-{{$loop->index + 1}}">

                    <div class="single-table text-center">

                        <div class="plan-header">

                            <h3>{{$subscription->text}}</h3>

                            <p>{{$subscription->desc}}</p>

                            <h4 class="plan-price">${{$subscription->price}}</h4>

                        </div>





                        <ul class="text-center">

                            <li>Duration: {{$subscription->name}}</li>

                            <li>Allowed Accounts: {{$subscription->account}}</li>

                        </ul>

                        <a href="/user/subscription" class="plan-submit hvr-bubble-float-right">buy now</a>

                    </div>

                </div>

            @endforeach



        </div>



    </div>

</section>





<!-- end priceing table -->

<!-- start Testimonial table -->

<div class="container mt-5 mb-5">

    <div class="row g-2">

        <div class="col-md-4">

            <div class="card p-3 text-center px-4">

                <div class="user-image"> <img src="https://i.imgur.com/PKHvlRS.jpg" class="rounded-circle" width="80"> </div>

                <div class="user-content">

                    <h5 class="mb-0">Bruce Hardy</h5> <span>Software Developer</span>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

                </div>

                <div class="ratings"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card p-3 text-center px-4">

                <div class="user-image"> <img src="https://i.imgur.com/w2CKRB9.jpg" class="rounded-circle" width="80"> </div>

                <div class="user-content">

                    <h5 class="mb-0">Mark Smith</h5> <span>Web Developer</span>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

                </div>

                <div class="ratings"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card p-3 text-center px-4">

                <div class="user-image"> <img src="https://i.imgur.com/ACeArwY.jpg" class="rounded-circle" width="80"> </div>

                <div class="user-content">

                    <h5 class="mb-0">Veera Duncan</h5> <span>Software Architect</span>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

                </div>

                <div class="ratings"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>

            </div>

        </div>

    </div>

</div>





<!-- Start of Blog section

    ============================================= -->

{{--<section id="soft-m-blog" class="soft-m-blog-section">--}}

{{--    <div class="container">--}}

{{--        <div class="soft-m-section-title text-center soft-m-headline">--}}

{{--            <span>Insights</span>--}}

{{--            <h2>News Feeds</h2>--}}

{{--        </div>--}}

{{--        <div class="soft-m-blog-content">--}}

{{--            <div class="row justify-content-center">--}}

{{--                <div class="col-lg-4 col-md-6">--}}

{{--                    <div class="soft-m-blog-img-text wow fadeFromUp" data-wow-delay="0ms" data-wow-duration="1500ms">--}}

{{--                        <div class="soft-m-blog-img position-relative">--}}

{{--                            <img src="{{url('/')}}/front_assets/img/soft/blog/sbl1.jpg" alt="">--}}

{{--                            <div class="soft-m-blog-date soft-m-headline  text-center">--}}

{{--                                <a href="#">29<span>Nov</span></a>--}}

{{--                            </div>--}}

{{--                        </div>--}}

{{--                        <div class="soft-m-blog-text soft-m-headline ">--}}

{{--                            <span class="soft-meta-cat">Software</span>--}}

{{--                            <h3><a href="#">We make it simple grow--}}

{{--                                    in the cloud and scale</a></h3>--}}

{{--                            <div class="soft-m-author-mete clearfix">--}}

{{--                                <div class="soft-b-author float-left">--}}

{{--                                    <div class="soft-b-author-img float-left">--}}

{{--                                        <img src="{{url('/')}}/front_assets/img/soft/blog/stb1.jpg" alt="">--}}

{{--                                    </div>--}}

{{--                                    <div class="soft-b-author-name">--}}

{{--                                        <h4> <a href="#">Alex D. Denz</a> </h4>--}}

{{--                                    </div>--}}

{{--                                </div>--}}

{{--                                <div class="soft-b-more float-right">--}}

{{--                                    <a href="#">Read More</a>--}}

{{--                                </div>--}}

{{--                            </div>--}}

{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}

{{--                <div class="col-lg-4 col-md-6">--}}

{{--                    <div class="soft-m-blog-img-text wow fadeFromUp" data-wow-delay="200ms" data-wow-duration="1500ms">--}}

{{--                        <div class="soft-m-blog-img position-relative">--}}

{{--                            <img src="{{url('/')}}/front_assets/img/soft/blog/sbl2.jpg" alt="">--}}

{{--                            <div class="soft-m-blog-date soft-m-headline  text-center">--}}

{{--                                <a href="#">29<span>Nov</span></a>--}}

{{--                            </div>--}}

{{--                        </div>--}}

{{--                        <div class="soft-m-blog-text soft-m-headline ">--}}

{{--                            <span class="soft-meta-cat">Software</span>--}}

{{--                            <h3><a href="#">We make it simple grow--}}

{{--                                    in the cloud and scale</a></h3>--}}

{{--                            <div class="soft-m-author-mete clearfix">--}}

{{--                                <div class="soft-b-author float-left">--}}

{{--                                    <div class="soft-b-author-img float-left">--}}

{{--                                        <img src="{{url('/')}}/front_assets/img/soft/blog/stb2.jpg" alt="">--}}

{{--                                    </div>--}}

{{--                                    <div class="soft-b-author-name">--}}

{{--                                        <h4> <a href="#">Alex D. Denz</a> </h4>--}}

{{--                                    </div>--}}

{{--                                </div>--}}

{{--                                <div class="soft-b-more float-right">--}}

{{--                                    <a href="#">Read More</a>--}}

{{--                                </div>--}}

{{--                            </div>--}}

{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}

{{--                <div class="col-lg-4 col-md-6">--}}

{{--                    <div class="soft-m-blog-img-text wow fadeFromUp" data-wow-delay="400ms" data-wow-duration="1500ms">--}}

{{--                        <div class="soft-m-blog-img position-relative">--}}

{{--                            <img src="{{url('/')}}/front_assets/img/soft/blog/sbl3.jpg" alt="">--}}

{{--                            <div class="soft-m-blog-date soft-m-headline  text-center">--}}

{{--                                <a href="#">29<span>Nov</span></a>--}}

{{--                            </div>--}}

{{--                        </div>--}}

{{--                        <div class="soft-m-blog-text soft-m-headline ">--}}

{{--                            <span class="soft-meta-cat">Software</span>--}}

{{--                            <h3><a href="#">We make it simple grow--}}

{{--                                    in the cloud and scale</a></h3>--}}

{{--                            <div class="soft-m-author-mete clearfix">--}}

{{--                                <div class="soft-b-author float-left">--}}

{{--                                    <div class="soft-b-author-img float-left">--}}

{{--                                        <img src="{{url('/')}}/front_assets/img/soft/blog/stb3.jpg" alt="">--}}

{{--                                    </div>--}}

{{--                                    <div class="soft-b-author-name">--}}

{{--                                        <h4> <a href="#">Alex D. Denz</a> </h4>--}}

{{--                                    </div>--}}

{{--                                </div>--}}

{{--                                <div class="soft-b-more float-right">--}}

{{--                                    <a href="#">Read More</a>--}}

{{--                                </div>--}}

{{--                            </div>--}}

{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}

{{--            </div>--}}

{{--        </div>--}}

{{--    </div>--}}

{{--</section>--}}

<!-- End of Blog section

    ============================================= -->



<!-- Start of call to action section

    ============================================= -->

<section id="soft-m-call-action" class="soft-m-call-action-section position-relative">

    <div class="container">

        <div class="row">

            <div class="col-lg-6">

                <div class="soft-m-section-title  soft-m-headline">

                    <span>Call To Action</span>

                    <h2>Want to try out our 7day trail pass for FREE? </h2>

                </div>

            </div>

            <div class="col-lg-6">

                <div class="soft-m-call-action-content">

                    <div class="row">

                        <div class="col-md-6">

                            <div class="soft-call-icon-text text-center" data-tilt data-tilt-max="10">

                                <div class="soft-call-icon">

                                    <span>SIGNUP NOW</span>

                                    <img src="{{url('/')}}/front_assets/img/soft/icon/sc1.png" alt="">

                                </div>

                                <div class="soft-c-btn">

                                    <a href="/register"><i class="fas fa-cloud-download-alt"></i> SIGNUP</a>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="soft-call-icon-text text-center" data-tilt data-tilt-max="10">

                                <div class="soft-call-icon">

                                    <span>Try A Demo</span>

                                    <img src="{{url('/')}}/front_assets/img/soft/icon/sc2.png" alt="">

                                </div>

                                <div class="soft-c-btn">

                                    <a href="#"><i class="fas fa-desktop"></i> Try A Demo</a>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- End of call to action section

    ============================================= -->



<!-- Start of Footer section

    ============================================= -->

<section id="soft-m-footer" class="soft-m-footer-section">

    <div class="soft-m-footer-top">

        <div class="container">

            <div class="soft-m-footer-top-content">

                <div class="row">

                    <div class="col-lg-6">

                        <div class="soft-m-footer-contact">

                            <span>Connect With Us</span>

                            <a href="#"><i class="fab fa-facebook-f"></i></a>

                            <a href="#"><i class="fab fa-twitter"></i></a>

                            <a href="#"><i class="fab fa-youtube"></i></a>

                            <a href="#"><i class="fab fa-behance"></i></a>

                        </div>

                    </div>

                    <div class="col-lg-6">

                        <div class="soft-m-footer-top-menu ul-li">

                            <ul>

                                <li><a href="#">Comapny</a></li>

                                <li><a href="#">Team Members</a></li>

                                <li><a href="#">Careers</a></li>

                                <li><a href="#">Help & FAQs</a></li>

                            </ul>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="soft-m-footer-top">

        <div class="container">

            <div class="soft-m-footer-top-content">

                <div class="row">

                    <div class="col-lg-12">

                        <div class="soft-m-footer-contact">

                            <span>Risk Disclaimer for Forex Trading</span>

                            <p>Trading foreign exchange on margin carries a high level of risk, and may not be suitable for all investors. Past performance is not indicative of future results. The high degree of leverage can work against you as well as for you. Before deciding to invest in foreign exchange you should carefully consider your investment objectives, level of experience, and risk appetite. The possibility exists that you could sustain a loss of some or all of your initial investment and therefore you should not invest money that you cannot afford to lose. You should be aware of all the risks associated with foreign exchange trading, and seek advice from an independent financial advisor if you have any doubts. Trading foreign currencies can be a challenging and potentially profitable opportunity for investors. However, before deciding to participate in the Forex market, you should carefully consider your investment objectives, level of experience, and risk appetite. Most importantly, do not invest money you cannot afford to lose. There is considerable exposure to risk in any foreign exchange transaction. Any transaction involving currencies involves risks including, but not limited to, the potential for changing political and/or economic conditions that may substantially affect the price or liquidity of a currency. Investments in foreign exchange speculation may also be susceptible to sharp rises and falls as the relevant market values fluctuate. The leveraged nature of Forex trading means that any market movement will have an equally proportional effect on your deposited funds. This may work against you as well as for you. Not only may investors get back less than they invested, but in the case of higher risk strategies, investors may lose the entirety of their investment. It is for this reason that when speculating in such markets it is advisable to use only risk capital</p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="soft-m-footer-content">

        <div class="container">

            <div class="soft-m-footer-wrapper">

                <div class="row">

                    <div class="col-lg-4 col-md-12">

                        <div class="soft-m-footer-widget">

                            <div class="soft-m-logo-widget pera-content">

                                <div class="soft-m-footer-logo float-left">

                                    <a href="#"><img src="{{url('/')}}/front_assets/img/soft/logo/logo1.png" width="97" height="32" alt="logo"></a>
<br>

                                </div>

                                <div class="soft-m-footer-support d-inline-block position-relative">

                                    GC � 2022 All Rights Reserved <b> <a target="_blank" href="http://grandeurcapital.net/">Grandeur Capital</a> </b>

                                </div>

{{--                                <p>--}}

{{--                                    Free <a href="#">soft-m</a>system for your sales team with all the essential tools sales funnel, pipeline management, sales reports, <a href="#">360-degree</a> customer view, support for repeat sales--}}

{{--                                </p>--}}

                                <div class="soft-footer-btn text-center">

                                    <a href="#"><i class="fas fa-desktop"></i> Try A Demo</a>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-8 col-md-12">

                        <div class="soft-m-footer-widget soft-m-headline pera-content">

                            <div class="soft-m-footer-menu-widget ul-li-block">

                                <h3 class="widget-title">Support</h3>

                                <ul>

                                    <li><a href="#">Knowledge Base</a></li>

                                    <li><a href="#">Blog</a></li>

                                    <li><a href="#">Developer API</a></li>

                                    <li><a href="#">Contact</a></li>

                                </ul>

                                <div class="soft-m-footer-store">

                                </div>

                            </div>

                        </div>

                        <div class="soft-m-footer-widget soft-m-headline pera-content">

                            <div class="soft-m-footer-menu-widget ul-li-block">

                                <h3 class="widget-title">Features</h3>

                                <ul>

                                    <li><a href="#">Sales Management</a></li>

                                    <li><a href="#">Contact Management</a></li>

                                    <li><a href="#">Project Management</a></li>

                                    <li><a href="#">HR Management</a></li>

                                    <li><a href="#">Integrations and API</a></li>

                                    <li><a href="#">Gmail &amp; G Suite</a></li>

                                </ul>

                            </div>

                        </div>

                        <div class="soft-m-footer-widget soft-m-headline pera-content">

                            <div class="soft-m-footer-menu-widget ul-li-block">

                                <h3 class="widget-title">About</h3>

                                <ul>

                                    <li><a href="#">About</a></li>

                                    <li><a href="#">Affiliate Program</a></li>

                                    <li><a href="#">Customer Spotlight</a></li>

                                    <li><a href="#">Reseller Program</a></li>

                                    <li><a href="#">Careers</a></li>

                                    <li><a href="#">Terms of Service</a></li>

                                </ul>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- End of Footer section

    ============================================= -->



<!-- JS library -->

<script src="{{url('/')}}/front_assets/js/jquery.js"></script>

<script src="{{url('/')}}/front_assets/js/popper.min.js"></script>

<script src="{{url('/')}}/front_assets/js/appear.js"></script>

<script src="{{url('/')}}/front_assets/js/bootstrap.min.js"></script>

<script src="{{url('/')}}/front_assets/js/wow.min.js"></script>

<script src="{{url('/')}}/front_assets/js/jquery.fancybox.js"></script>

<script src="{{url('/')}}/front_assets/js/tilt.jquery.min.js"></script>

<script src="{{url('/')}}/front_assets/js/owl.js"></script>

<script src="{{url('/')}}/front_assets/js/typer-new.js"></script>

<script src="{{url('/')}}/front_assets/js/jquery.mCustomScrollbar.concat.min.js"></script>

<script src="{{url('/')}}/front_assets/js/odometer.js"></script>

<script src="{{url('/')}}/front_assets/js/parallax-scroll.js"></script>

<script src="{{url('/')}}/front_assets/js/software.js"></script>

</body>

</html>