@php
    $user = \Illuminate\Support\Facades\Auth::user();
@endphp
<header class="transition">
    <div class="container">
        <div class="row flex-align">
            <div class="col-lg-4 col-md-3 col-8">
                <div class="logo">
                    <a href="/"><img src="{{url('/')}}/front_assets/img/soft/logo/logo1.png" style="height: 50px" class="transition" alt="Cryptcon"></a>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-12 text-right">
                <div class="menu-toggle">
                    <span></span>
                </div>
                <div class="menu">
                    <ul class="d-inline-block">
                        <li><a href="/">GRANDEUR CAPITAL</a></li>
{{--                        <li><a href="/f_products">Products</a></li>--}}
{{--                        <li><a href="/allproducts">Library</a></li>--}}
{{--                        <li><a href="/">Live Trading</a></li>--}}
{{--                        <li><a href="/">Group Chat</a></li>--}}
{{--                        <li><a href="/forums">Forums</a></li>--}}
{{--                        <li><a href="/">Support</a></li>--}}
                    </ul>
                    @if(empty($user))
                    <div class="signin d-inline-block">
                        <a href="/login" class="btn">Sign in</a>
                        <a href="/register" class="btn">Register</a>
                    </div>
                    @else
                        <div class="signin d-inline-block">
                            <a
                                    class="btn"
                                    @if($user->is_admin)
                                    href="/admin/home"
                                    @else
                                    href="/user/dashboard"
                                    @endif
                                    class="dropdown-toggle" >Dashboard</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>