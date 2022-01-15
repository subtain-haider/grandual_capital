<!DOCTYPE html>
<html>
	<head>
		@include('layouts.head_meta')
	</head>
<body>

@include('navigation.header')


<div class="container">
    <!-- start general2 container -->
        @yield('content')
    <!-- end general 2 container end -->
</div>

@include('navigation.footer')
	
</body>
</html>
