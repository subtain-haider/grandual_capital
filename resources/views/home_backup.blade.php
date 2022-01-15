@extends('user.app')

@section('content')

    @php($ref_by = request()->ref_by ?? '')

    <style>
        .site-hero, .site-hero .row
        {
            min-height: 600px;
        }
    </style>
    <section
            class="site-hero"
            style="background-image: url({{asset('assets/banner2.jpeg')}})"
            id="section-home"
            data-stellar-background-ratio="0.5"
    >

        <div class="container">
            <div
                    class="
            row
            intro-text
            align-items-center
            justify-content-center
        "
            >
                <div class="col-md-10 text-center pt-5">
                    <h1 class="site-heading site-animate">
                        Welcome to
                        <strong class="d-block">Grandeur Capital</strong>
                    </h1>
                    {{-- <strong
                        class="
                            d-block
                            text-white text-uppercase
                            letter-spacing
                        "
                        >and this is My Rezume</strong
                    > --}}
                </div>
            </div>
        </div>
    </section>
    <!-- section -->

    <section class="site-section" id="section-portfolio">
        <div class="container">
            <div class="row">
                <div class="section-heading text-center col-md-12">
                    <h2>Featured <strong>Products</strong></h2>
                </div>
            </div>
            <div class="filters">
                <ul>
                    <li class="active" data-filter="*">All</li>
                    @foreach ($categories as $category)

                        <li data-filter=".category{{$category->id}}">{{$category->category}}</li>
                        {{-- <li data-filter=".mockup">Mockup</li> --}}
                        {{-- <li data-filter=".typography">Typography</li> --}}
                        {{-- <li data-filter=".photography">Photography</li> --}}
                    @endforeach
                </ul>
            </div>


            <div class="filters-content">
                <div class="row grid">
                    @foreach ($products as $product)

                        <a href="/product/{{$product->id}}">
                            <div class="single-portfolio col-sm-4 all category{{$product->category_id}}">
                                <div class="relative">
                                    <div class="thumb">
                                        <div class="overlay overlay-bg"></div>
                                        <img
                                                class="image img-fluid"
                                                src="{{url('/') . '/'. $product->image}}"
                                                alt=""
                                        />
                                    </div>
                                </div>
                                <div class="p-inner">
                                    <h4>{{$product->name}}</h4>
                                    <div class="cat">{{$product->category->category}}</div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    {{-- <div class="single-portfolio col-sm-4 all mockup">
                        <div class="relative">
                            <div class="thumb">
                                <div class="overlay overlay-bg"></div>
                                <img
                                    class="image img-fluid"
                                    src="{{asset('assets/user/images/p2.jpg')}}"
                                    alt=""
                                />
                            </div>
                            <a href="{{asset('assets/user/images/p2.jpg')}}" class="img-pop-up">
                                <div class="middle">
                                    <div
                                        class="
                                            text
                                            align-self-center
                                            d-flex
                                        "
                                    >
                                        <img
                                            src="{{asset('assets/user/images/preview.png')}}"
                                            alt=""
                                        />
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="p-inner">
                            <h4>Product Box Package Mockup</h4>
                            <div class="cat">Mockup</div>
                        </div>
                    </div>
                    <div class="single-portfolio col-sm-4 all packaging">
                        <div class="relative">
                            <div class="thumb">
                                <div class="overlay overlay-bg"></div>
                                <img
                                    class="image img-fluid"
                                    src="{{asset('assets/user/images/p3.jpg')}}"
                                    alt=""
                                />
                            </div>
                            <a href="{{asset('assets/user/images/p3.jpg')}}" class="img-pop-up">
                                <div class="middle">
                                    <div
                                        class="
                                            text
                                            align-self-center
                                            d-flex
                                        "
                                    >
                                        <img
                                            src="{{asset('assets/user/images/preview.png')}}"
                                            alt=""
                                        />
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="p-inner">
                            <h4>Creative Package Design</h4>
                            <div class="cat">Packaging</div>
                        </div>
                    </div>
                    <div class="single-portfolio col-sm-4 all packaging">
                        <div class="relative">
                            <div class="thumb">
                                <div class="overlay overlay-bg"></div>
                                <img
                                    class="image img-fluid"
                                    src="{{asset('assets/user/images/p4.jpg')}}"
                                    alt=""
                                />
                            </div>
                            <a href="{{asset('assets/user/images/p4.jpg')}}" class="img-pop-up">
                                <div class="middle">
                                    <div
                                        class="
                                            text
                                            align-self-center
                                            d-flex
                                        "
                                    >
                                        <img
                                            src="{{asset('assets/user/images/preview.png')}}"
                                            alt=""
                                        />
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="p-inner">
                            <h4>Packaging Brand</h4>
                            <div class="cat">Packaging</div>
                        </div>
                    </div>
                    <div class="single-portfolio col-sm-4 all typography">
                        <div class="relative">
                            <div class="thumb">
                                <div class="overlay overlay-bg"></div>
                                <img
                                    class="image img-fluid"
                                    src="{{asset('assets/user/images/p5.jpg')}}"
                                    alt=""
                                />
                            </div>
                            <a href="{{asset('assets/user/images/p5.jpg')}}" class="img-pop-up">
                                <div class="middle">
                                    <div
                                        class="
                                            text
                                            align-self-center
                                            d-flex
                                        "
                                    >
                                        <img
                                            src="{{asset('assets/user/images/preview.png')}}"
                                            alt=""
                                        />
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="p-inner">
                            <h4>Isometric 3D Extrusion</h4>
                            <div class="cat">Typography</div>
                        </div>
                    </div>
                    <div class="single-portfolio col-sm-4 all photography">
                        <div class="relative">
                            <div class="thumb">
                                <div class="overlay overlay-bg"></div>
                                <img
                                    class="image img-fluid"
                                    src="{{asset('assets/user/images/p6.jpg')}}"
                                    alt=""
                                />
                            </div>
                            <a href="{{asset('assets/user/images/p6.jpg')}}" class="img-pop-up">
                                <div class="middle">
                                    <div
                                        class="
                                            text
                                            align-self-center
                                            d-flex
                                        "
                                    >
                                        <img
                                            src="{{asset('assets/user/images/preview.png')}}"
                                            alt=""
                                        />
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="p-inner">
                            <h4>White Space Photography</h4>
                            <div class="cat">photography</div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="row">
                <div class="section-heading text-center col-md-12">
                    <a href="/allproducts" class="btn btn-lg bg-white">View All Products</a>
                </div>
            </div>
        </div>
    </section>

    <section class="site-section" id="section-about">
        <div class="container">
            <div class="row mb-5 align-items-center">
                <div class="col-lg-7 pr-lg-5 mb-5 mb-lg-0">
                    <img
                            src="{{asset('assets/banner2.jpeg')}}"
                            alt="Image placeholder"
                            class="img-fluid"
                    />
                </div>
                <div class="col-lg-5 pl-lg-5">
                    <div class="section-heading">
                        <h2>About <strong>Us</strong></h2>
                    </div>
                    <p class="lead">
                        Separated they live in Bookmarksgrove right at the
                        coast of the Semantics, a large language ocean.
                    </p>
                    <p class="mb-5">
                        A small river named Duden flows by their place and
                        supplies it with the necessary regelialia. It is a
                        paradisematic country, in which roasted parts of
                        sentences fly into your mouth.
                    </p>


                </div>
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="section-heading text-center">
                        <h2>Client <strong>Testimonial</strong></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="block-47 d-flex mb-5">
                        <div class="block-47-image">
                            <img
                                    src="{{asset('assets/user/images/person_1.jpg')}}"
                                    alt="Image placeholder"
                                    class="img-fluid"
                            />
                        </div>
                        <blockquote class="block-47-quote">
                            <p>
                                &ldquo;Far far away, behind the word
                                mountains, far from the countries Vokalia
                                and Consonantia, there live the blind texts.
                                Separated they live in Bookmarksgrove right
                                at the coast of the Semantics, a large
                                language ocean.&rdquo;
                            </p>
                            <cite class="block-47-quote-author"
                            >&mdash; Ethan McCown, CEO
                                <a href="#">XYZ Inc.</a></cite
                            >
                        </blockquote>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="block-47 d-flex mb-5">
                        <div class="block-47-image">
                            <img
                                    src="{{asset('assets/user/images/person_2.jpg')}}"
                                    alt="Image placeholder"
                                    class="img-fluid"
                            />
                        </div>
                        <blockquote class="block-47-quote">
                            <p>
                                &ldquo;Far far away, behind the word
                                mountains, far from the countries Vokalia
                                and Consonantia, there live the blind texts.
                                Separated they live in Bookmarksgrove right
                                at the coast of the Semantics, a large
                                language ocean.&rdquo;
                            </p>
                            <cite class="block-47-quote-author"
                            >&mdash; Craig Gowen, CEO
                                <a href="#">XYZ Inc.</a></cite
                            >
                        </blockquote>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="block-47 d-flex mb-5">
                        <div class="block-47-image">
                            <img
                                    src="{{asset('assets/user/images/person_3.jpg')}}"
                                    alt="Image placeholder"
                                    class="img-fluid"
                            />
                        </div>
                        <blockquote class="block-47-quote">
                            <p>
                                &ldquo;Far far away, behind the word
                                mountains, far from the countries Vokalia
                                and Consonantia, there live the blind texts.
                                Separated they live in Bookmarksgrove right
                                at the coast of the Semantics, a large
                                language ocean.&rdquo;
                            </p>
                            <cite class="block-47-quote-author"
                            >&mdash; Ethan McCown, CEO
                                <a href="#">XYZ Inc.</a></cite
                            >
                        </blockquote>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="block-47 d-flex mb-5">
                        <div class="block-47-image">
                            <img
                                    src="{{asset('assets/user/images/person_4.jpg')}}"
                                    alt="Image placeholder"
                                    class="img-fluid"
                            />
                        </div>
                        <blockquote class="block-47-quote">
                            <p>
                                &ldquo;Far far away, behind the word
                                mountains, far from the countries Vokalia
                                and Consonantia, there live the blind texts.
                                Separated they live in Bookmarksgrove right
                                at the coast of the Semantics, a large
                                language ocean.&rdquo;
                            </p>
                            <cite class="block-47-quote-author"
                            >&mdash; Craig Gowen, CEO
                                <a href="#">XYZ Inc.</a></cite
                            >
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="site-section pb-0" id="section-services">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="section-heading text-center">
                        <h2>Our <strong>Services</strong></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 text-center mb-5">
                    <div
                            class="site-service-item site-animate"
                            data-animate-effect="fadeIn"
                    >
                <span class="icon">
                    <span class="icon-browser2"></span>
                </span>
                        <h3 class="mb-4">Web Design</h3>
                        <p>
                            Far far away, behind the word mountains, far
                            from the countries Vokalia and Consonantia,
                            there live the blind texts. Separated they live
                            in Bookmarksgrove right at the coast of the
                            Semantics, a large language ocean.
                        </p>
                        <p>
                            <a href="#" class="site-link"
                            >Learn More
                                <i class="icon-chevron-right"></i
                                ></a>
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 text-center mb-5">
                    <div
                            class="site-service-item site-animate"
                            data-animate-effect="fadeIn"
                    >
                <span class="icon">
                    <span class="icon-presentation"></span>
                </span>
                        <h3 class="mb-4">Search Engine Optimization</h3>
                        <p>
                            A small river named Duden flows by their place
                            and supplies it with the necessary regelialia.
                            It is a paradisematic country, in which roasted
                            parts of sentences fly into your mouth.
                        </p>
                        <p>
                            <a href="#" class="site-link"
                            >Learn More
                                <i class="icon-chevron-right"></i
                                ></a>
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 text-center mb-5">
                    <div
                            class="site-service-item site-animate"
                            data-animate-effect="fadeIn"
                    >
                <span class="icon">
                    <span class="icon-video2"></span>
                </span>
                        <h3 class="mb-4">Video Editing</h3>
                        <p>
                            Even the all-powerful Pointing has no control
                            about the blind texts it is an almost
                            unorthographic life One day however a small line
                            of blind text by the name of Lorem Ipsum decided
                            to leave for the far World of Grammar.
                        </p>
                        <p>
                            <a href="#" class="site-link"
                            >Learn More
                                <i class="icon-chevron-right"></i
                                ></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="site-section" id="section-blog">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-5">
                    <div class="section-heading text-center">
                        <h2>Blog on <strong>Medium</strong></h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 col-lg-4 mb-4">
                    <div class="blog-entry">
                        <a href="#"
                        ><img
                                    src="{{asset('assets/user/images/post_1.jpg')}}"
                                    alt="Image placeholder"
                                    class="img-fluid"
                            /></a>
                        <div class="blog-entry-text">
                            <h3>
                                <a href="#"
                                >Creative Product Designer From
                                    Facebook</a
                                >
                            </h3>
                            <p class="mb-4">
                                Even the all-powerful Pointing has no
                                control about the blind texts it is an
                                almost unorthographic.
                            </p>

                            <div class="meta">
                                <a href="#"
                                ><span class="icon-calendar"></span> Aug
                                    7, 2018</a
                                >
                                <a href="#"
                                ><span class="icon-bubble"></span> 5
                                    Comments</a
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4 mb-4">
                    <div class="blog-entry">
                        <a href="#"
                        ><img
                                    src="{{asset('assets/user/images/post_2.jpg')}}"
                                    alt="Image placeholder"
                                    class="img-fluid"
                            /></a>
                        <div class="blog-entry-text">
                            <h3>
                                <a href="#"
                                >Creative Product Designer From
                                    Facebook</a
                                >
                            </h3>
                            <p class="mb-4">
                                Even the all-powerful Pointing has no
                                control about the blind texts it is an
                                almost unorthographic.
                            </p>

                            <div class="meta">
                                <a href="#"
                                ><span class="icon-calendar"></span> Aug
                                    7, 2018</a
                                >
                                <a href="#"
                                ><span class="icon-bubble"></span> 5
                                    Comments</a
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4 mb-4">
                    <div class="blog-entry">
                        <a href="#"
                        ><img
                                    src="{{asset('assets/user/images/post_3.jpg')}}"
                                    alt="Image placeholder"
                                    class="img-fluid"
                            /></a>
                        <div class="blog-entry-text">
                            <h3>
                                <a href="#"
                                >Creative Product Designer From
                                    Facebook</a
                                >
                            </h3>
                            <p class="mb-4">
                                Even the all-powerful Pointing has no
                                control about the blind texts it is an
                                almost unorthographic.
                            </p>

                            <div class="meta">
                                <a href="#"
                                ><span class="icon-calendar"></span> Aug
                                    7, 2018</a
                                >
                                <a href="#"
                                ><span class="icon-bubble"></span> 5
                                    Comments</a
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="site-section" id="section-contact">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-5">
                    <div class="section-heading text-center">
                        <h2>Get <strong>In Touch</strong></h2>
                    </div>
                </div>

                <div class="col-md-7 mb-5 mb-md-0">
                    <form action="" class="site-form">
                        <h3 class="mb-5">Get In Touch</h3>
                        <div class="form-group">
                            <input
                                    type="text"
                                    class="form-control px-3 py-4"
                                    placeholder="Your Name"
                            />
                        </div>
                        <div class="form-group">
                            <input
                                    type="email"
                                    class="form-control px-3 py-4"
                                    placeholder="Your Email"
                            />
                        </div>
                        <div class="form-group">
                            <input
                                    type="email"
                                    class="form-control px-3 py-4"
                                    placeholder="Your Phone"
                            />
                        </div>
                        <div class="form-group mb-5">
                    <textarea
                            class="form-control px-3 py-4"
                            cols="30"
                            rows="10"
                            placeholder="Write a Message"
                    ></textarea>
                        </div>
                        <div class="form-group">
                            <input
                                    type="submit"
                                    class="btn btn-primary px-4 py-3"
                                    value="Send Message"
                            />
                        </div>
                    </form>
                </div>
                <div class="col-md-5 pl-md-5">
                    <h3 class="mb-5">My Contact Details</h3>
                    <ul class="site-contact-details">
                        <li>
                            <span class="text-uppercase">Email</span>
                            site@gmail.com
                        </li>
                        <li>
                            <span class="text-uppercase">Phone</span>
                            +30 976 1382 9921
                        </li>
                        <li>
                            <span class="text-uppercase">Fax</span>
                            +30 976 1382 9922
                        </li>
                        <li>
                            <span class="text-uppercase">Address</span>
                            San Francisco, CA <br />
                            4th Floor8 Lower <br />
                            San Francisco street, M1 50F
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    {{---------------------------------------------------------- Login Modal -----------------------------------------------}}
    <div class="container">
        <!-- The Modal -->
        <div class="modal" id="loginModal">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content" style="background: #F5F5F5">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-dark">Login</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group row text-dark">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="background: white;color: black">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row text-dark">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="background: white;color: black">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    {{-- @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif --}}
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

    </div>
    {{---------------------------------------------------------- Login Modal End ----------------------------------------------}}


    {{---------------------------------------------------------- Register Modal -----------------------------------------------}}
    <div class="container">
        <!-- The Modal -->
        <div class="modal" id="registerModal">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content" style="background: #F5F5F5">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" style="color: black">Register</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row text-dark">
                                <label for="" class="col-md-4 col-form-label text-md-right">Full Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="fname" autofocus style="background: white;color: black">
                                </div>
                            </div>

                            <div class="form-group row text-dark">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Username</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus style="background: white;color: black">

                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row text-dark">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" style="background: white;color: black">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row text-dark">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" style="background: white;color: black">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row text-dark">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" style="background: white;color: black">
                                </div>
                            </div>

                            {{-- <div class="form-group row text-dark">
                                <label for="ref_link" class="col-md-4 col-form-label text-md-right">Refrence link</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="ref_by" value="{{ old('ref_by') }}" style="background: white;color: black">
                                </div>
                            </div> --}}

                            {{-- hidden fields --}}
                            {{--                <input type="hidden" class="form-control" name="status" value="Deactive" style="background: white;color: black">--}}
                            <input type="hidden" class="form-control" name="ref_by" value="{{$ref_by ?? ''}}">

                            {{-- hidden fields --}}

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

    </div>
    {{---------------------------------------------------------- Register Modal End ----------------------------------------------}}

@endsection

{{-- Script for opening Popup --}}
<script>
    function login()
    {
        $("#loginModal").modal();
    }
    function register()
    {
        $("#registerModal").modal();
    }
</script>
{{-- Script for opening Popup --}}


