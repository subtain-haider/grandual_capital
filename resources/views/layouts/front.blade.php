<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <title>GRANDEUR CAPITAL</title>

    <!-- Essential styles -->
    <link rel="stylesheet" href="{{url('/')}}/assets/bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{url('/')}}/font-awesome/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{{url('/')}}/assets/fancybox/jquery.fancybox.css?v=2.1.5" media="screen">

    <!-- Boomerang styles -->
    <link id="wpStylesheet" type="text/css" href="{{url('/')}}/css/global-style.css" rel="stylesheet" media="screen">


    <!-- Favicon -->
    <link href="{{url('/')}}/images/favicon.png" rel="icon" type="image/png">

    <!-- Assets -->
    <link rel="stylesheet" href="{{url('/')}}/assets/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="{{url('/')}}/assets/owl-carousel/owl.theme.css">
    <link rel="stylesheet" href="{{url('/')}}/assets/sky-forms/css/sky-forms.css">
    <!--[if lt IE 9]>
    <link rel="stylesheet" href="{{url('/')}}/assets/sky-forms/css/sky-forms-ie8.css">
    <![endif]-->

    <!-- Required JS -->
    <script src="{{url('/')}}/js/jquery.js"></script>
    <script src="{{url('/')}}/js/jquery-ui.min.js"></script>

    <!-- Page scripts -->
    <link rel="stylesheet" href="{{url('/')}}/assets/layerslider/css/layerslider.css" type="text/css">
    <style>
        .is-invalid{
            border: 1px solid red !important;
        }
        .invalid-feedback{
            color: red;
        }
    </style>
    @php
        $user = \Illuminate\Support\Facades\Auth::user();
    @endphp
</head>
<body>
<!-- MODALS -->

<!-- MOBILE MENU - Option 2 -->
<section id="navMobile" class="aside-menu left">
    <form class="form-horizontal form-search">
        <div class="input-group">
            <input type="search" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                <button id="btnHideMobileNav" class="btn btn-close" type="button" title="Hide sidebar"><i class="fa fa-times"></i></button>
            </span>
        </div>
    </form>
    <div id="dl-menu" class="dl-menuwrapper">
        <ul class="dl-menu"></ul>
    </div>
</section>

<!-- SLIDEBAR -->
<section id="asideMenu" class="aside-menu right">
    <form class="form-horizontal form-search">
        <div class="input-group">
            <input type="search" class="form-control" placeholder="Search..." />
            <span class="input-group-btn">
                <button id="btnHideAsideMenu" class="btn btn-close" type="button" title="Hide sidebar"><i class="fa fa-times"></i></button>
            </span>
        </div>
    </form>

    <h5 class="side-section-title">Optional sidebar menu</h5>
    <div class="nav">
        <ul>
            <li>
                <a href="#">Home</a>
            </li>
            <li>
                <a href="#">About us</a>
            </li>
            <li>
                <a href="#">Blog</a>
            </li>
            <li>
                <a href="#">Work</a>
            </li>
            <li>
                <a href="#">Online shop</a>
            </li>
        </ul>
    </div>

    <h5 class="side-section-title">Social media</h5>
    <div class="social-media">
        <a href="#"><i class="fa fa-facebook facebook"></i></a>
        <a href="#"><i class="fa fa-google-plus google"></i></a>
        <a href="#"><i class="fa fa-twitter twitter"></i></a>
    </div>

    <h5 class="side-section-title">Contact information</h5>
    <div class="contact-info">
        <h5>Address</h5>
        <p>5th Avenue, New York - United States</p>

        <h5>Email</h5>
        <p>hello@webpixels.ro</p>

        <h5>Phone</h5>
        <p>+10 724 1234 567</p>
    </div>
</section>

<!-- MAIN WRAPPER -->
<div class="body-wrap">
    <!-- This section is only for demonstration purpose only. Check out the docs for more informations" -->
    <div id="divStyleSwitcher" class="style-switcher-slidebar">
        <a href="#" id="cmdShowStyleSwitcher" class="open-panel hidden-xs"><i class="fa fa-cog"></i></a>
        <div class="switch-panel">
            <h3>Boomerang - Style Builder</h3>
            <div class="panel-section">
                <h4 class="title text-uppercase font-normal">Layout options</h4>

                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>I prefer it:</label>
                            <select id="cmbLayoutStyle" class="form-control">
                                <option value="1">Fluid</option>
                                <option value="2">Boxed</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label></label>
                            <select id="cmbLayoutColor" class="form-control">
                                <option value="1">Light</option>
                                <option value="2">Dark</option>
                            </select>
                        </div>
                    </div>
                </div>

                <label class="mt-10">Predefined body backgrounds</label>
                <span class="clearfix"></span>
                <span id="cmbBodyBg" class="color-switch">
                <a href="#" id="cmdBodyBg1" class="body-bg-1 ttip" data-toggle="bottom" title="Solid color"></a>
                <a href="#" id="cmdBodyBg2" class="body-bg-2 ttip" data-toggle="bottom" title="Black Lozenge"></a>
                <a href="#" id="cmdBodyBg3" class="body-bg-3 ttip" data-toggle="bottom" title="Squairy Light"></a>
                <a href="#" id="cmdBodyBg4" class="body-bg-4 ttip" data-toggle="bottom" title="Dark Dotted"></a>
                <a href="#" id="cmdBodyBg5" class="body-bg-5 ttip" data-toggle="bottom" title="Skulls"></a>
                <a href="#" id="cmdBodyBg6" class="body-bg-6 ttip" data-toggle="bottom" title="Image Background - 1"></a>
                <a href="#" id="cmdBodyBg7" class="body-bg-7 ttip" data-toggle="bottom" title="Image Background - 2"></a>
                <span class="clearfix"></span>
            </span>

                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Section title:</label>
                            <select id="cmbSectionTitleStyle" class="form-control">
                                <option value="1">Style 1</option>
                                <option value="2">Style 2</option>
                                <option value="3">Style 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Color:</label>
                            <select id="cmbSectionTitleColor" class="form-control" disabled="disabled">
                                <option value="1">Base</option>
                                <option value="2">Alt Base</option>
                                <option value="3">Light</option>
                                <option value="4">Dark</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="panel-section">
                <h4 class="title text-uppercase font-normal">Header options</h4>

                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Header:</label>
                            <select id="cmbHeaderStyle" class="form-control">
                                <option value="2">Header 1: Default navbar</option>
                                <option value="3">Header 2: Default navbar + Top header</option>
                                <option value="1">Header 3: Header + Navbar</option>
                                <option value="4">Header 4: Cover</option>
                                <!--
                                                            <option value="5">Header 1: Default + Mobile nav 2</option>
                                                            <option value="6">Header 2: Default + Top header + Mobile nav 2</option>
                                                            <option value="7">Header 3: Header + Navbar + Mobile nav 2</option>
                                                            <option value="8">Header 4: Cover</option> -->
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Top header color:</label>
                            <select id="cmbTopHeaderColor" class="form-control" disabled="disabled">
                                <option value="1">Light</option>
                                <option value="2">Dark</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-section">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Nav shadow</label>
                            <select id="cmbNavShadow" class="form-control">
                                <option value="1">No</option>
                                <option value="2">Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Dropdown arrow:</label>
                            <select id="cmbNavDropdownArrow" class="form-control">
                                <option value="2">Yes</option>
                                <option value="1">No</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="panel-section">
                <h4 class="title text-uppercase font-normal">Color options</h4>

                <label>Predefined colors</label>
                <span class="clearfix"></span>
                <span class="color-switch">
                <a href="#" id="cmdSchemeRed" class="color-red" title="Red">Red</a>
                <a href="#" id="cmdSchemeViolet" class="color-violet" title="Violet">Violet</a>
                <a href="#" id="cmdSchemeBlue" class="color-blue" title="Blue">Blue</a>
                <a href="#" id="cmdSchemeGreen" class="color-green" title="Green">Green</a>
                <a href="#" id="cmdSchemeYellow" class="color-yellow" title="Yellow">Yellow</a>
                <a href="#" id="cmdSchemeOrange" class="color-orange" title="Orange">Orange</a>
            </span>
            </div>

            <hr>

            <div class="panel-section">
                <h4 class="title">
                    <span class="text-uppercase font-normal">Special</span>
                    <a href="#" class="pop" title="About customization" data-content="We created some examples that show you the multitude of options you have so you make this template as you wish. <br><br>Customization is very easy and it is made in only one file.">
                        <i class="fa fa-question-circle"></i>
                    </a>
                    <label class="badge base pull-right">New</label>
                </h4>

                <label>Predefined schemes</label>
                <span class="clearfix"></span>
                <span class="color-switch">
                <a href="#" id="cmdSchemeBW" class="color-bw ttip" data-toggle="top" title="Black & White">Black and white</a>
                <a href="#" id="cmdSchemeDark" class="color-dark ttip" data-toggle="top" title="Dark">Dark</a>
                <a href="#" id="cmdSchemeFlat" class="color-flat ttip" data-toggle="top" title="Flat">Flat</a>
            </span>

            </div>

            <div class="panel-section mt-15 hide">
                <a href="#"><span>Reset all applied styles</span></a>
                <br><br>
            </div>

        </div>
    </div>
    <!-- HEADER -->
    <div id="divHeaderWrapper" style="position: sticky !important; top: 0; z-index: 99999">
        <header class="header-standard-2">
            <!-- MAIN NAV -->
            <div class="navbar navbar-wp navbar-arrow mega-nav" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle navbar-toggle-aside-menu">
                            <i class="fa fa-outdent icon-custom"></i>
                        </button>
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <i class="fa fa-bars icon-custom"></i>
                        </button>

                        <a class="navbar-brand" href="/" title="Boomerang | One template. Infinite solutions">
                            <img src="{{url('/')}}/logo.jpg" alt="Boomerang | One template. Infinite solutions">
                        </a>
                    </div>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="hidden-md hidden-lg">
                                <div class="bg-light-gray">
                                    <form class="form-horizontal form-light p-15" role="form">
                                        <div class="input-group input-group-lg">
                                            <input type="text" class="form-control" placeholder="I want to find ...">
                                            <span class="input-group-btn">
                                        <button class="btn btn-white" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <li class="dropdown dropdown-meganav mega-dropdown-fluid">
                                <a href="/" class="dropdown-toggle" >Home</a>
                            </li>
                            <li class="dropdown dropdown-meganav mega-dropdown-fluid">
                                <a href="/f_products" class="dropdown-toggle" >Products</a>
                            </li>
                            <li class="dropdown dropdown-meganav mega-dropdown-fluid">
                                <a href="/allproducts" class="dropdown-toggle" >Library</a>
                            </li>
                            <li class="dropdown dropdown-meganav mega-dropdown-fluid">
                                <a href="/" class="dropdown-toggle" >Live Trading</a>
                            </li>
                            <li class="dropdown dropdown-meganav mega-dropdown-fluid">
                                <a href="/" class="dropdown-toggle" >Group Chat</a>
                            </li>
                            <li class="dropdown dropdown-meganav mega-dropdown-fluid">
                                <a href="/forums" class="dropdown-toggle" >Forums</a>
                            </li>
                            <li class="dropdown dropdown-meganav mega-dropdown-fluid">
                                <a href="/" class="dropdown-toggle" >Support</a>
                            </li>

                            @if(empty($user))

                                <li class="dropdown dropdown-meganav mega-dropdown-fluid">
                                    <a href="/login" class="dropdown-toggle" >Login</a>

                                </li>
                                <li class="dropdown dropdown-meganav mega-dropdown-fluid">
                                    <a href="/register" class="dropdown-toggle" >Sign up</a>

                                </li>
                            @else
                                <li class="dropdown dropdown-meganav mega-dropdown-fluid">
                                    <a
                                            @if($user->is_admin)
                                                href="/admin/home"
                                            @else
                                                href="/user/dashboard"
                                            @endif
                                            class="dropdown-toggle" >Dashboard</a>
                                </li>
                                <li class="dropdown dropdown-meganav mega-dropdown-fluid">
                                    <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-toggle" >Logout</a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">{{ csrf_field() }} </form>
                                </li>
                            @endif
{{--                            <li class="dropdown dropdown-aux animate-click" data-animate-in="animated bounceInUp" data-animate-out="animated fadeOutDown" style="z-index:500;">--}}
{{--                                <a href="#" class="dropdown-form-toggle" data-toggle="dropdown"><i class="fa fa-search"></i></a>--}}
{{--                                <ul class="dropdown-menu dropdown-menu-user animate-wr">--}}
{{--                                    <li id="dropdownForm">--}}
{{--                                        <div class="dropdown-form">--}}
{{--                                            <form class="form-horizontal form-light p-15" role="form">--}}
{{--                                                <div class="input-group">--}}
{{--                                                    <input type="text" class="form-control" placeholder="I want to find ...">--}}
{{--                                                    <span class="input-group-btn">--}}
{{--                                                <button class="btn btn-base" type="button">Go</button>--}}
{{--                                            </span>--}}
{{--                                                </div>--}}
{{--                                            </form>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
                            {{--                            <li class="dropdown-aux">--}}
                            {{--                                <a href="#" id="cmdAsideMenu" class="dropdown-toggle dropdown-form-toggle" title="Open slidebar">--}}
                            {{--                                    <i class="fa fa-outdent"></i>--}}
                            {{--                                </a>--}}
                            {{--                            </li>--}}
                        </ul>

                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </header>        </div>



    @yield('content')
    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="col">
                        <h4>Contact us</h4>
                        <ul>
                            <li>5th Avenue, New York - United States</li>
                            <li>Phone: +10 724 1234 567 | Fax: +10 724 1234 567 </li>
                            <li>Email: <a href="mailto:hello@example.com" title="Email Us">hello@example.com</a></li>
                            <li>Skype: <a href="skype:my.business?call" title="Skype us">my-business</a></li>
                            <li>Creating great templates is our passion</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="col">
                        <h4>Mailing list</h4>
                        <p>Sign up if you would like to receive occasional treats from us.</p>
                        <form class="form-horizontal form-light">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Your email address...">
                                <span class="input-group-btn">
                                    <button class="btn btn-base" type="button">Go!</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="col col-social-icons">
                        <h4>Follow us</h4>
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-google-plus"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-skype"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                        <a href="#"><i class="fa fa-youtube-play"></i></a>
                        <a href="#"><i class="fa fa-flickr"></i></a>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="col">
                        <h4>About us</h4>
                        <p class="no-margin">
                            Boomerang MultiPurpose Template is a multi-solution product made with simplicity in mind so you can benefit as much as possible from it.
                            <br><br>
                            <a href="#" class="btn btn-block btn-base btn-icon fa-check"><span>Try it now</span></a>
                        </p>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-lg-9 copyright">
                    2014 © Web Pixels. All rights reserved.
                    <a href="#">Terms and conditions</a>
                </div>
                <div class="col-lg-3">
                    <a href="http://www.webpixels.ro" title="Made with love by Web Pixels" target="_blank" class="">
                        <img src="{{url('/')}}/images/webpixels-footer-logo.png" alt="Web Pixels - Designing Forward | Logo" class="pull-right">
                    </a>
                </div>
            </div>
        </div>
    </footer>
</div>

<!-- Essentials -->
<script src="{{url('/')}}/js/modernizr.custom.js"></script>
<script src="{{url('/')}}/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="{{url('/')}}/js/jquery.mousewheel-3.0.6.pack.js"></script>
<script src="{{url('/')}}/js/jquery.easing.js"></script>
<script src="{{url('/')}}/js/jquery.metadata.js"></script>
<script src="{{url('/')}}/js/jquery.hoverup.js"></script>
<script src="{{url('/')}}/js/jquery.hoverdir.js"></script>
<script src="{{url('/')}}/js/jquery.stellar.js"></script>

<!-- Boomerang mobile nav - Optional  -->
<script src="{{url('/')}}/assets/responsive-mobile-nav/js/jquery.dlmenu.js"></script>
<script src="{{url('/')}}/assets/responsive-mobile-nav/js/jquery.dlmenu.autofill.js"></script>

<!-- Forms -->
<script src="{{url('/')}}/assets/ui-kit/js/jquery.powerful-placeholder.min.js"></script>
<script src="{{url('/')}}/assets/ui-kit/js/cusel.min.js"></script>
<script src="{{url('/')}}/assets/sky-forms/js/jquery.form.min.js"></script>
<script src="{{url('/')}}/assets/sky-forms/js/jquery.validate.min.js"></script>
<script src="{{url('/')}}/assets/sky-forms/js/jquery.maskedinput.min.js"></script>
<script src="{{url('/')}}/assets/sky-forms/js/jquery.modal.js"></script>

<!-- Assets -->
<script src="{{url('/')}}/assets/hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
<script src="{{url('/')}}/assets/page-scroller/jquery.ui.totop.min.js"></script>
<script src="{{url('/')}}/assets/mixitup/jquery.mixitup.js"></script>
<script src="{{url('/')}}/assets/mixitup/jquery.mixitup.init.js"></script>
<script src="{{url('/')}}/assets/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
<script src="{{url('/')}}/assets/waypoints/waypoints.min.js"></script>
<script src="{{url('/')}}/assets/milestone-counter/jquery.countTo.js"></script>
<script src="{{url('/')}}/assets/easy-pie-chart/js/jquery.easypiechart.js"></script>
<script src="{{url('/')}}/assets/social-buttons/js/rrssb.min.js"></script>
<script src="{{url('/')}}/assets/nouislider/js/jquery.nouislider.min.js"></script>
<script src="{{url('/')}}/assets/owl-carousel/owl.carousel.js"></script>
<script src="{{url('/')}}/assets/bootstrap/js/tooltip.js"></script>
<script src="{{url('/')}}/assets/bootstrap/js/popover.js"></script>

<!-- Sripts for individual pages, depending on what plug-ins are used -->
<script src="{{url('/')}}/assets/layerslider/js/greensock.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/layerslider/js/layerslider.transitions.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/layerslider/js/layerslider.kreaturamedia.jquery.js" type="text/javascript"></script>
<!-- Initializing the slider -->
<script>
    jQuery("#layerslider").layerSlider({
        pauseOnHover: true,
        autoPlayVideos: false,
        skinsPath: 'assets/layerslider/skins/',
        responsive: false,
        responsiveUnder: 1280,
        layersContainer: 1280,
        skin: 'borderlessdark3d',
        hoverPrevNext: true,
    });
</script>

<!-- Boomerang App JS -->
<script src="{{url('/')}}/js/wp.app.js"></script>
<!--[if lt IE 9]>
<script src="{{url('/')}}/js/html5shiv.js"></script>
<script src="{{url('/')}}/js/respond.min.js"></script>
<![endif]-->

<!-- Temp -- You can remove this once you started to work on your project -->
<script src="{{url('/')}}/js/jquery.cookie.js"></script>
<script src="{{url('/')}}/js/wp.switcher.js"></script>
<script type="text/javascript" src="{{url('/')}}/js/wp.ga.js"></script>


</body>
</html>