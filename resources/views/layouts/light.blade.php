<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <title>Grandeur Capital</title>

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="{{url('/')}}/front_assets/img/fv.png" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{url('/front/light')}}/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{url('/front/light')}}/css/color.css">
    <link rel="stylesheet" type="text/css" href="{{url('/front/light')}}/css/responsive.css">

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>

    <link rel="stylesheet" type="text/css" href="https://keith-wood.name/css/jquery.signature.css">
    <style>
        .kbw-signature { width: 100%; height: 200px;}
        #sig canvas{
            width: 100% !important;
            height: auto;
        }
    </style>
</head>
<body>

<!-- Start preloader -->
{{--<div id="preloader"></div>--}}
<!-- End preloader -->

<!-- Top scroll -->
<div class="top-scroll transition">
    <a href="#banner" class="scrollTo"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
</div>
<!-- Top scroll End -->
@include('includes.header')

@yield('content')

<script type="text/javascript">
    var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });
</script>

@include('includes.footer')
<script src="{{url('/front/light')}}/js/jquery-3.4.1.min.js"></script>
<script src="{{url('/front/light')}}/js/bootstrap.min.js"></script>
<script src="{{url('/front/light')}}/js/owl.carousel.min.js"></script>
<script src="{{url('/front/light')}}/js/snap.svg-min.js"></script>
<script src="{{url('/front/light')}}/js/jquery.listtopie.min.js"></script>
<script src="{{url('/front/light')}}/js/animation.js"></script>
<script src="{{url('/front/light')}}/js/custom.js"></script>

</body>

</html>
