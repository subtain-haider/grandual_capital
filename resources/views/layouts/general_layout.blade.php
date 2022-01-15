<!DOCTYPE html>
<html>
    <head>
        @include('layouts.head_meta')
    </head>
<body>

@include('navigation.header')

@if(announcement_info('show_status') == "on" && thisroute() == "index" || announcement_info('show_status') == "on" && thisroute() == "home")
    <div style="min-height:5px"></div>
@endif

<div class="container">
    <div class="row">
      <!-- start main container -->
        <div class="col-lg-8 col-md-12 central-block">
            @yield('content')
        </div>
        <!-- main container end -->

        <!-- start right sidebar -->
        <div class="col-lg-4 col-md-12 paddingzero">
            @include('navigation.sidebar')
        </div>
	<!-- end right sidebar -->
  </div>
</div>

{{--@include('navigation.footer')--}}

</body>
</html>
