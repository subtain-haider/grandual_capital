{{-- user dashboad parts --}}
@include('user.dashboard.layouts.header')
@include('user.dashboard.layouts.sidebar')
<div class="nk-wrap ">
@include('user.dashboard.layouts.nav')
@yield('content')
@include('user.dashboard.layouts.footer')


{{-- user dashboad parts --}}

