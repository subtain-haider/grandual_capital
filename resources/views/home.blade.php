@extends('layouts.front')

@section('content')
    <!-- Optional header components (ex: slider) -->
    <!-- Importing slider content -->
    <section id="slider-wrapper" class="layer-slider-wrapper layer-slider-dynamic">
        <div id="layerslider" style="width:100%;height:520px;">
            <!-- Slide 1 -->
            <div class="ls-slide" data-ls="transition2d:1;timeshift:-1000;">
                <!-- slide background -->
                <img src="images/backgrounds/full-bg-7.jpg" class="ls-bg" alt="Slide background"/>

                <!-- Left Text -->
                <h3 class="ls-l title-lg c-white text-shadow text-uppercase text-center strong" style="width:100%; top:25%; left:50%;" data-ls="offsetxin:0;offsetyin:250;durationin:1000;delayin:500;offsetxout:0;offsetyout:-8;easingout:easeInOutQuart;scalexout:1.2;scaleyout:1.2;">
                    Welcome to Grandeur Capital
                </h3>
                <h3 class="ls-l title c-white text-wrapped black text-uppercase text-center strong" style="top:50%; left:50%;" data-ls="offsetxin:0;offsetyin:250;durationin:1000;delayin:1000;offsetxout:0;offsetyout:-8;easingout:easeInOutQuart;scalexout:1.2;scaleyout:1.2;">
                    Vision.Analysis.Success
                </h3>

                <h3 class="ls-l title-xs c-white text-shadow text-uppercase text-center strong" style="width:100%; top:72%; left:50%;" data-ls="offsetxin:0;offsetyin:250;durationin:1000;delayin:1500;offsetxout:0;offsetyout:-8;easingout:easeInOutQuart;scalexout:1.2;scaleyout:1.2;">
                    Join Now
                </h3>
            </div>

            <div class="ls-slide" data-ls="transition2d:1;timeshift:-1000;">
                <!-- slide background -->
                <img src="images/backgrounds/full-bg-7.jpg" class="ls-bg" alt="Slide background"/>

                <!-- Left Text -->
                <h3 class="ls-l title-lg c-white text-shadow text-uppercase text-center strong" style="width:100%; top:25%; left:50%;" data-ls="offsetxin:0;offsetyin:250;durationin:1000;delayin:500;offsetxout:0;offsetyout:-8;easingout:easeInOutQuart;scalexout:1.2;scaleyout:1.2;">
                    Welcome to Grandeur Capital
                </h3>
                <h3 class="ls-l title c-white text-wrapped black text-uppercase text-center strong" style="top:50%; left:50%;" data-ls="offsetxin:0;offsetyin:250;durationin:1000;delayin:1000;offsetxout:0;offsetyout:-8;easingout:easeInOutQuart;scalexout:1.2;scaleyout:1.2;">
                    Vision.Analysis.Success
                </h3>

                <h3 class="ls-l title-xs c-white text-shadow text-uppercase text-center strong" style="width:100%; top:72%; left:50%;" data-ls="offsetxin:0;offsetyin:250;durationin:1000;delayin:1500;offsetxout:0;offsetyout:-8;easingout:easeInOutQuart;scalexout:1.2;scaleyout:1.2;">
                    Join Now
                </h3>
            </div>


        </div>
    </section>

    <!-- MAIN CONTENT -->

    <section class="slice white inset-shadow-1 bb">
        <div class="wp-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class="section-title-wr">
                            <h3 class="section-title left"><span>About Grandeur Capital</span></h3>
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque neque eget diam posuere porta.
                            Quisque ut nulla at nunc vehicula lacinia. Proin adipiscing porta tellus, ut feugiat nibh adipiscing sit amet.
                            In eu justo a felis faucibus ornare vel id metus.
                            <br><br>
                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In eu libero ligula.
                            Quisque ut nulla at nunc vehicula lacinia metus.
                        </p>
                    </div>
                    <div class="col-5 ">
                        <img src="/logo.jpg" height="200" alt="" class="ml-5">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="slice light-gray bb">
        <div class="wp-section">
            <div class="container">
                <div class="section-title-wr">
                    <h3 class="section-title left"><span>Featured products</span></h3>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#profile_0" >All</a>
                    </li>
                    @foreach($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#profile_{{$category->id}}" role="tab">{{$category->category}}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active in" id="profile_0" >
                        <div class="row">
                            @foreach($products as $product)
                                <div class="col-md-3">
                                    @include('product_card')
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @foreach($categories as $category)
                        <div class="tab-pane fade" id="profile_{{$category->id}}">
                            <div class="row">
                                @foreach($category->products as $product)
                                    <div class="col-md-3">
                                        @include('product_card')
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                </div>
            </div>
        </div>
    </section>


    <section id="companyCarousel" class="carousel carousel-2 slide bg-white bb" data-ride="carousel">
        <div class="container relative">
            <!-- Indicators -->
            <div class="row">
                <div class="col-md-6">
                    <h2 class="title">Become an Affiliate</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </p>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.
                    </p>
                </div>
                <div class="col-md-6">
                    <img src="images/prv/device-3.png" class="img-responsive" alt="">
                </div>
            </div>
        </div>
    </section>
    <section class="slice light-gray bb">
        <div class="wp-section">
            <div class="container">
                <div class="section-title-wr">
                    <h3 class="section-title left"><span>Our services</span></h3>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="wp-block hero white no-margin">
                            <div class="thmb-img">
                                <img src="/trading.jpg" width="100" height="100" alt="">
                            </div>

                            <h2>Trading Tool</h2>
                            <p class="text-center">Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum. </p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="wp-block hero white no-margin">
                            <div class="thmb-img">
                                <img src="/live.jpg" width="100" height="100" alt="">
                            </div>

                            <h2>Live Trading Rooms</h2>
                            <p class="text-center">Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum. </p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="wp-block hero white no-margin">
                            <div class="thmb-img">
                                <img src="/group.jpg" width="100" height="100" alt="">
                            </div>

                            <h2>Group Chat</h2>
                            <p class="text-center">Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum. </p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="wp-block hero white no-margin">
                            <div class="thmb-img">
                                <img src="/forum.jpg" width="100" height="100" alt="">
                            </div>

                            <h2>Forums</h2>
                            <p class="text-center">Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum. </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="slice light-gray bb">
        <div class="wp-section pricing-plans pricing-plans-2">
            <div class="section-title-wr">
                <h3 class="section-title center">
                    <span>The Arsenal Package</span>
                    <small>This package gives you access to all our tools and services. Subscribe now!</small>
                </h3>
            </div>
            <div class="container">
                <div class="row">
                    @foreach($subscriptions as $subscription)
                        <div class="col-md-3">
                            <div class="wp-block default">
                                <div class="plan-header base">
                                    <h2 class="plan-title">{{$subscription->text}}</h2>
                                </div>
                                <div class="plan-price">
                                    <h3 class="price-tag">
                                        <span>$</span>{{$subscription->price}}<sup>99</sup>
                                    </h3>
                                    {{--                                <span class="price-interval">per month</span>--}}
                                </div>
                                <ul>
                                    <li>{{$subscription->name}} Months</li>
                                    <li>No. of Keys: {{$subscription->account}}</li>
                                    <li>{{$subscription->desc}}</li>
                                    <li>24/7 support</li>
                                </ul>
                                <p class="plan-select-block">
                                    <a href="/user/subscription" class="btn btn-lg btn-block-bm btn-base btn-icon btn-check" hidefocus="true">
                                        <span>Subscribe</span>
                                    </a>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    <!-- CLIENTS -->
@endsection