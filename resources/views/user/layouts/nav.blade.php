<nav
            class="navbar navbar-expand-lg site-navbar navbar-light bg-light"
            id="pb-navbar"
        >
            <div class="container">
                <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarsExample09"
                    aria-controls="navbarsExample09"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div
                    class="collapse navbar-collapse justify-content-md-center"
                    id="navbarsExample09"
                >
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" id="home" href="#section-home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="allproducts" href="#section-portfolio"
                                >Products</a
                            >
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#section-about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#section-contact"
                                >Contact</a>
                        </li>
                        {{-- Checking login sessions --}}
                        @if(!Auth::user())
                            <li class="nav-item">
                                <a class="nav-link" onclick="login()" style="cursor: pointer;">login</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" onclick="register()" style="cursor: pointer;">Register</a>
                            </li>
                        @else
                            <li class="nav-item">
                                {{-- <a class="nav-link" href="{{ url('/home') }}" style="cursor: pointer;">Logout</a> --}}
                                <a class="nav-link" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Logout </a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">{{ csrf_field() }} </form>
                            </li>

                        @endif
                        {{-- Checking login sessions end--}}
                    </ul>
                    @if(Auth::user())
                        @if(Auth::user()->is_admin)
                            <a class="nav-link" href="/admin/home"
                            >My Dashboard</a>
                        @else
                            <a class="nav-link" href="/user/dashboard"
                            >My Dashboard</a>
                        @endif
                    @endif
                </div>
            </div>
        </nav>

<script>
    document.getElementById("home").onclick = function () {
        location.href = "/";
    };
    document.getElementById("allproducts").onclick = function () {
        location.href = "/allproducts";
    };
</script>