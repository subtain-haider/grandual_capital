@php
    $layout = \App\Models\Front::first();
@endphp
@extends('layouts.'.$layout->layout)

@section('content')


    <section class="home-banner parallax" id="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 position-u flex-align wow fadeInLeft">
                    <div class="banner-contain">
                        <h1 class="banner-heading">{{$layout->top_header}}</h1>
                        <p class="banner-des">{{$layout->top_sub_header}}</p>
                        <a href="#" class="btn">Learn more</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 position-u wow fadeInRight">
                    <div class="banner-img">
                        <img src="{{url('/').'/'.$layout->header_image}}" alt="banner">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section style="padding: 15px">
        <div class="container">
            <div class="row">
                <br/>
    {{--            <div class="col text-center">--}}
    {{--                <h2>Bootstrap 4 counter</h2>--}}
    {{--                <p>counter to count up to a target number</p>--}}
    {{--            </div>--}}



            </div>
            <div class="row text-center">
                <div class="col">
                    <div class="counter">
                        <i class="fa fa-coffee fa-2x"></i>
                        <h2 class="timer count-title count-number" data-to="1700" data-speed="1500"></h2>
                        <p class="count-text ">Users</p>
                    </div>
                </div>
                <div class="col">
                    <div class="counter">
                        <i class="fa fa-code fa-2x"></i>
                        <h2 class="timer count-title count-number" data-to="100" data-speed="1500"></h2>
                        <p class="count-text ">Download</p>
                    </div>
                </div>
                <div class="col">
                    <div class="counter">
                        <i class="fa fa-lightbulb-o fa-2x"></i>
                        <h2 class="timer count-title count-number" data-to="11900" data-speed="1500"></h2>
                        <p class="count-text ">Likes</p>
                    </div></div>
                <div class="col">
                    <div class="counter">
                        <i class="fa fa-bug fa-2x"></i>
                        <h2 class="timer count-title count-number" data-to="157" data-speed="1500"></h2>
                        <p class="count-text ">5 star Rating</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="work-part darkblue ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12 wow fadeInUp">
                    <div class="section-heading text-center pb-65">
{{--                        <label class="sub-heading">what is cryptcon</label>--}}
                        <h2 class="heading-title">Who are we</h2>
                        <p class="heading-des">{{$layout->who_header}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 text-center flex-align justify-center wow fadeInLeft">
                    <div class="work-box">
                        <img src="{{url('/').'/'.$layout->how_it_works_image}}" class="rotation-img" alt="Work Process">
                    </div>
                </div>
                <div class="col-md-6 flex-align wow fadeInRight">
                    <div class="work-box">
                        <h3 class="work-process-title pb-25">{{$layout->who_sub_header}}</h3>
                        <p class="work-des pb-20">{{$layout->how_it_works}} </p>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="feature-part skyblue bg-pattern pt-100 pb-10">
        <div class="container">
            <div class="row">
                <div class="col-md-12 wow fadeInUp">
                    <div class="section-heading text-center pb-65">
{{--                        <label class="sub-heading">cryptcon Feature</label>--}}
                        <h2 class="heading-title">Best Features</h2>
{{--                        <p class="heading-des">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>--}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 wow fadeInUp pb-80">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <img src="{{url('/front/dark')}}/images/feature-1.png" alt="Safe & Secure">
                        </div>
                        <div class="feature-contain pt-25">
                            <a class="feature-title pb-15">{{$layout->feature_1_header}}</a>
                            <p class="feature-des">{{$layout->feature_1}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 wow fadeInUp pb-80">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <a href="/"><img src="{{url('/front/dark')}}/images/feature-2.png" alt="Early Bonus"></a>
                        </div>
                        <div class="feature-contain pt-25">
                            <a class="feature-title pb-15">{{$layout->feature_2_header}}</a>
                            <p class="feature-des">{{$layout->feature_2}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 wow fadeInUp pb-80">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <a href="/"><img src="{{url('/front/dark')}}/images/feature-3.png" alt="Univarsal Access"></a>
                        </div>
                        <div class="feature-contain pt-25">
                            <a class="feature-title pb-15">{{$layout->feature_3_header}}</a>
                            <p class="feature-des">{{$layout->feature_3}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 wow fadeInUp pb-80">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <a href="/"><img src="{{url('/front/dark')}}/images/feature-4.png" alt="Secure Storage"></a>
                        </div>
                        <div class="feature-contain pt-25">
                            <a class="feature-title pb-15">{{$layout->feature_4_header}}</a>
                            <p class="feature-des">{{$layout->feature_4}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 wow fadeInUp pb-80">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <a href="/"><img src="{{url('/front/dark')}}/images/feature-5.png" alt="Low Cost"></a>
                        </div>
                        <div class="feature-contain pt-25">
                            <a class="feature-title pb-15">{{$layout->feature_5_header}}</a>
                            <p class="feature-des">{{$layout->feature_5}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 wow fadeInUp pb-80">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <a href="/"><img src="{{url('/front/dark')}}/images/feature-6.png" alt="Several Profit"></a>
                        </div>
                        <div class="feature-contain pt-25">
                            <a class="feature-title pb-15">{{$layout->feature_6_header}}</a>
                            <p class="feature-des">{{$layout->feature_6}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

{{--    <section class="timeline darkblue ptb-100">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-12 wow fadeInUp">--}}
{{--                    <div class="section-heading text-center pb-65">--}}
{{--                        <label class="sub-heading">roadmap</label>--}}
{{--                        <h2 class="heading-title">The Timeline</h2>--}}
{{--                        <p class="heading-des">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="main-roadmap">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-12">--}}
{{--                        <div class="h-border wow fadeInLeft"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-12">--}}
{{--                        <div class="roadmap-slider owl-carousel">--}}
{{--                            <div class="roadmap wow fadeInLeft">--}}
{{--                                <div class="roadmap-box text-center">--}}
{{--                                    <div class="date-title">March 2018</div>--}}
{{--                                    <div class="map-graphic">--}}
{{--                                        <div class="small-round"><span></span></div>--}}
{{--                                        <div class="v-row"></div>--}}
{{--                                    </div>--}}
{{--                                    <div class="roadmap-detail-box">--}}
{{--                                        <p>Lorem Ipsum has been the industry's standard dummy text </p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="roadmap wow fadeInLeft">--}}
{{--                                <div class="roadmap-box text-center">--}}
{{--                                    <div class="date-title">April 2018</div>--}}
{{--                                    <div class="map-graphic">--}}
{{--                                        <div class="small-round"><span></span></div>--}}
{{--                                        <div class="v-row"></div>--}}
{{--                                    </div>--}}
{{--                                    <div class="roadmap-detail-box">--}}
{{--                                        <p>Lorem Ipsum has been the industry's standard dummy text </p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="roadmap wow fadeInLeft">--}}
{{--                                <div class="roadmap-box text-center">--}}
{{--                                    <div class="date-title">May 2018</div>--}}
{{--                                    <div class="map-graphic">--}}
{{--                                        <div class="small-round"><span></span></div>--}}
{{--                                        <div class="v-row"></div>--}}
{{--                                    </div>--}}
{{--                                    <div class="roadmap-detail-box">--}}
{{--                                        <p>Lorem Ipsum has been the industry's standard dummy text </p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="roadmap wow fadeInLeft">--}}
{{--                                <div class="roadmap-box text-center">--}}
{{--                                    <div class="date-title">August 2018</div>--}}
{{--                                    <div class="map-graphic">--}}
{{--                                        <div class="small-round"><span></span></div>--}}
{{--                                        <div class="v-row"></div>--}}
{{--                                    </div>--}}
{{--                                    <div class="roadmap-detail-box">--}}
{{--                                        <p>Lorem Ipsum has been the industry's standard dummy text </p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

    <section class="team-part skyblue bg-pattern pt-100 pb-55">
        <div class="container">
            <div class="row">
                <div class="col-md-12 wow fadeInUp">
                    <div class="section-heading text-center pb-65">
                        <label class="sub-heading">meet the team</label>
                        <h2 class="heading-title">Our Team</h2>
{{--                        <p class="heading-des">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>--}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 wow fadeInLeft pb-45">
                    <div class="team-box flex-align">
                        <div class="team-img">
                            <a href="/"><img src="{{url('/').'/'.$layout->team_image_1}}" alt="team member"></a>
                        </div>
                        <div class="team-des">
                            <a href="/" class="member-name">{{$layout->team_name_1}}</a>
                            <p class="member-des">{{$layout->team_description_1}}</p>
                            <ul class="pt-15">
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pb-45 wow fadeInRight">
                    <div class="team-box flex-align">
                        <div class="team-img">
                            <a href="/"><img src="{{url('/').'/'.$layout->team_image_2}}" alt="team member"></a>
                        </div>
                        <div class="team-des">
                            <a href="/" class="member-name">{{$layout->team_name_2}}</a>
                            <p class="member-des">{{$layout->team_description_2}}</p>
                            <ul class="pt-15">
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 wow fadeInLeft pb-45">
                    <div class="team-box flex-align">
                        <div class="team-img">
                            <a href="/"><img src="{{url('/').'/'.$layout->team_image_3}}" alt="team member"></a>
                        </div>
                        <div class="team-des">
                            <a href="/" class="member-name">{{$layout->team_name_3}}</a>
                            <p class="member-des">{{$layout->team_description_3}}</p>
                            <ul class="pt-15">
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pb-45 wow fadeInRight">
                    <div class="team-box flex-align">
                        <div class="team-img">
                            <a href="/"><img src="{{url('/').'/'.$layout->team_image_4}}" alt="team member"></a>
                        </div>
                        <div class="team-des">
                            <a href="/" class="member-name">{{$layout->team_name_4}}</a>
                            <p class="member-des">{{$layout->team_description_4}}</p>
                            <ul class="pt-15">
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

{{--    <section id="tokensale-part" class="token-sale darkblue parallax ptb-100">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-6 wow fadeInLeft flex-align">--}}
{{--                    <div class="w-100">--}}
{{--                        <div class="section-heading pb-20">--}}
{{--                            <label class="sub-heading">token</label>--}}
{{--                            <h2 class="heading-title">Token Sale</h2>--}}
{{--                            <p class="heading-des">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>--}}
{{--                        </div>--}}
{{--                        <div class="token-graphic-detail">--}}
{{--                            <ul>--}}
{{--                                <li class="color-code-1">73% Finacial Overhead</li>--}}
{{--                                <li class="color-code-2">55% Bonus & found</li>--}}
{{--                                <li class="color-code-3">12% Gift Code Inventory</li>--}}
{{--                                <li class="color-code-4">32% Bounty and Overhead</li>--}}
{{--                                <li class="color-code-5">38% it infastrueture</li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-6 flex-align justify-center-r">--}}
{{--                    <div class="token-graph w-100">--}}
{{--                        <div class='donut'>--}}
{{--                            <div data-lcolor="#f8c04e">12.2</div>--}}
{{--                            <div data-lcolor="#ac56f7">32.6</div>--}}
{{--                            <div data-lcolor="#61f89f">38.2</div>--}}
{{--                            <div data-lcolor="#5ad6f8">55.2</div>--}}
{{--                            <div data-lcolor="#f85d77">73.2</div>--}}
{{--                        </div>--}}
{{--                        <div class="graph-logo">--}}
{{--                            <img src="{{url('/front/dark')}}/images/graph-logo.png" alt="cryptoz">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

    <section class="blog-part skyblue ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12 wow fadeInUp">
                    <div class="section-heading text-center pb-65">
                        <label class="sub-heading">news</label>
                        <h2 class="heading-title">Our Blog</h2>
{{--                        <p class="heading-des">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>--}}
                    </div>
                </div>
            </div>
            <div class="blog-slider owl-carousel">
                <div class="blog-box wow fadeInUp">
                    <div class="blog-img mb-15">
                        <a href="/"><img src="{{url('/front/dark')}}/images/blog-1.jpg" alt="blog"></a>
                    </div>
                    <div class="blog-des-box">
                        <a href="/" class="blog-title">Cryptocash is a clean, modern template clean</a>
                        <ul class="blog-date">
                            <li>March 20,2019</li>
                            <li>by john doe</li>
                        </ul>
                        <p class="blog-des">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do Lorem ipsum dolor sit amet, consectetur </p>
                        <a href="/" class="read-more">Read More</a>
                    </div>
                </div>
                <div class="blog-box wow fadeInUp">
                    <div class="blog-img mb-15">
                        <a href="/"><img src="{{url('/front/dark')}}/images/blog-2.jpg" alt="blog"></a>
                    </div>
                    <div class="blog-des-box">
                        <a href="/" class="blog-title">Cryptocash is a clean, modern template clean</a>
                        <ul class="blog-date">
                            <li>March 20,2019</li>
                            <li>by john doe</li>
                        </ul>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do Lorem ipsum dolor sit amet, consectetur </p>
                        <a href="/" class="read-more">Read More</a>
                    </div>
                </div>
                <div class="blog-box wow fadeInUp">
                    <div class="blog-img mb-15">
                        <a href="/"><img src="{{url('/front/dark')}}/images/blog-3.jpg" alt="blog"></a>
                    </div>
                    <div class="blog-des-box">
                        <a href="/" class="blog-title">Cryptocash is a clean, modern template clean</a>
                        <ul class="blog-date">
                            <li>March 20,2019</li>
                            <li>by john doe</li>
                        </ul>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do Lorem ipsum dolor sit amet, consectetur </p>
                        <a href="/" class="read-more">Read More</a>
                    </div>
                </div>
                <div class="blog-box wow fadeInUp">
                    <div class="blog-img mb-15">
                        <a href="/"><img src="{{url('/front/dark')}}/images/blog-1.jpg" alt="blog"></a>
                    </div>
                    <div class="blog-des-box">
                        <a href="/" class="blog-title">Cryptocash is a clean, modern template clean</a>
                        <ul class="blog-date">
                            <li>March 20,2019</li>
                            <li>by john doe</li>
                        </ul>
                        <p class="blog-des">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do Lorem ipsum dolor sit amet, consectetur </p>
                        <a href="/" class="read-more">Read More</a>
                    </div>
                </div>
                <div class="blog-box wow fadeInUp">
                    <div class="blog-img mb-15">
                        <a href="/"><img src="{{url('/front/dark')}}/images/blog-2.jpg" alt="blog"></a>
                    </div>
                    <div class="blog-des-box">
                        <a href="/" class="blog-title">Cryptocash is a clean, modern template clean</a>
                        <ul class="blog-date">
                            <li>March 20,2019</li>
                            <li>by john doe</li>
                        </ul>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do Lorem ipsum dolor sit amet, consectetur </p>
                        <a href="/" class="read-more">Read More</a>
                    </div>
                </div>
                <div class="blog-box wow fadeInUp">
                    <div class="blog-img mb-15">
                        <a href="/"><img src="{{url('/front/dark')}}/images/blog-3.jpg" alt="blog"></a>
                    </div>
                    <div class="blog-des-box">
                        <a href="/" class="blog-title">Cryptocash is a clean, modern template clean</a>
                        <ul class="blog-date">
                            <li>March 20,2019</li>
                            <li>by john doe</li>
                        </ul>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do Lorem ipsum dolor sit amet, consectetur </p>
                        <a href="/" class="read-more">Read More</a>
                    </div>
                </div>
                <div class="blog-box wow fadeInUp">
                    <div class="blog-img mb-15">
                        <a href="/"><img src="{{url('/front/dark')}}/images/blog-1.jpg" alt="blog"></a>
                    </div>
                    <div class="blog-des-box">
                        <a href="/" class="blog-title">Cryptocash is a clean, modern template clean</a>
                        <ul class="blog-date">
                            <li>March 20,2019</li>
                            <li>by john doe</li>
                        </ul>
                        <p class="blog-des">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do Lorem ipsum dolor sit amet, consectetur </p>
                        <a href="/" class="read-more">Read More</a>
                    </div>
                </div>
                <div class="blog-box wow fadeInUp">
                    <div class="blog-img mb-15">
                        <a href="/"><img src="{{url('/front/dark')}}/images/blog-2.jpg" alt="blog"></a>
                    </div>
                    <div class="blog-des-box">
                        <a href="/" class="blog-title">Cryptocash is a clean, modern template clean</a>
                        <ul class="blog-date">
                            <li>March 20,2019</li>
                            <li>by john doe</li>
                        </ul>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do Lorem ipsum dolor sit amet, consectetur </p>
                        <a href="/" class="read-more">Read More</a>
                    </div>
                </div>
                <div class="blog-box wow fadeInUp">
                    <div class="blog-img mb-15">
                        <a href="/"><img src="{{url('/front/dark')}}/images/blog-3.jpg" alt="blog"></a>
                    </div>
                    <div class="blog-des-box">
                        <a href="/" class="blog-title">Cryptocash is a clean, modern template clean</a>
                        <ul class="blog-date">
                            <li>March 20,2019</li>
                            <li>by john doe</li>
                        </ul>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do Lorem ipsum dolor sit amet, consectetur </p>
                        <a href="/" class="read-more">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ico-apps parallax-2 darkblue pt-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 wow fadeInLeft flex-bottom order-r-2">
                    <div class="ico-apps-img w-100 text-center">
                        <img src="{{url('/').'/'.$layout->second_last_image}}" alt="mobile apps">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInRight pb-100 order-r-1">
                    <div class="section-heading pb-20">
{{--                        <label class="sub-heading">ico apps</label>--}}
                        <h2 class="heading-title">{{$layout->second_last_title}}</h2>
                        <p class="heading-des pb-20"> {!!$layout->second_last_description!!}</p>
{{--                        <p class="heading-des pb-20"> {{$layout->second_last_description }}</p>--}}

{{--                        <ul class="check-list mb-30">--}}
{{--                            <li><span><i class="fa fa-check" aria-hidden="true"></i></span> <p>Crypto-news curation</p></li>--}}
{{--                            <li><span><i class="fa fa-check" aria-hidden="true"></i></span> <p>Natural Language Understanding</p></li>--}}
{{--                            <li><span><i class="fa fa-check" aria-hidden="true"></i></span> <p>Et harum quidem rerum facilis est et expedita distinctio.</p></li>--}}
{{--                        </ul>--}}
{{--                        <a href="#" class="btn">get the app now</a>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="faq-part skyblue pt-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12 wow fadeInUp">
                    <div class="section-heading text-center pb-65">
                        <label class="sub-heading">Faqs</label>
                        <h2 class="heading-title">Frequently Asked questions</h2>
{{--                        <p class="heading-des">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>--}}
                    </div>
                </div>
            </div>
{{--            <div class="row">--}}
{{--                <div class="col-md-12 wow fadeInUp">--}}
{{--                    <ul class="nav nav-tabs Frequently-tabs pb-55" id="myTab" role="tablist">--}}
{{--                        <li>--}}
{{--                            <a class="active" data-toggle="tab" href="#general" role="tab">general</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a data-toggle="tab" href="#ico" role="tab" >pre-ico & ico</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a data-toggle="tab" href="#Tokens" role="tab">Tokens</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a data-toggle="tab" href="#client" role="tab">client</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a data-toggle="tab" href="#legal" role="tab">legal</a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="row">
                <div class="col-md-12 wow fadeInUp">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="general" role="tabpanel">
                            <div class="row">
                                <div class="col-md-3 pb-65">
                                    <div class="faq-tab">
                                        <a href="/" class="qus-title">{{$layout->question_title_1}}</a>
                                        <p class="qus-des pt-10">{{$layout->question_description_1}}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 pb-65">
                                    <div class="faq-tab">
                                        <a href="/" class="qus-title">{{$layout->question_title_2}} </a>
                                        <p class="qus-des pt-10">{{$layout->question_description_2}}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 pb-65">
                                    <div class="faq-tab">
                                        <a href="/" class="qus-title">{{$layout->question_title_3}}</a>
                                        <p class="qus-des pt-10">{{$layout->question_description_3}}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 pb-65">
                                    <div class="faq-tab">
                                        <a href="/" class="qus-title">{{$layout->question_title_4}}</a>
                                        <p class="qus-des pt-10">{{$layout->question_description_4}}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 pb-65">
                                    <div class="faq-tab">
                                        <a href="/" class="qus-title">{{$layout->question_title_5}}</a>
                                        <p class="qus-des pt-10">{{$layout->question_description_5}}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 pb-65">
                                    <div class="faq-tab">
                                        <a href="/" class="qus-title">{{$layout->question_title_6}} </a>
                                        <p class="qus-des pt-10">{{$layout->question_description_6}}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 pb-65">
                                    <div class="faq-tab">
                                        <a href="/" class="qus-title">{{$layout->question_title_7}}</a>
                                        <p class="qus-des pt-10">{{$layout->question_description_7}}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 pb-65">
                                    <div class="faq-tab">
                                        <a href="/" class="qus-title">{{$layout->question_title_8}}</a>
                                        <p class="qus-des pt-10">{{$layout->question_description_8}}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 pb-65">
                                    <div class="faq-tab">
                                        <a href="/" class="qus-title">{{$layout->question_title_9}}</a>
                                        <p class="qus-des pt-10">{{$layout->question_description_9}}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 pb-65">
                                    <div class="faq-tab">
                                        <a href="/" class="qus-title">{{$layout->question_title_10}} </a>
                                        <p class="qus-des pt-10">{{$layout->question_description_10}}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 pb-65">
                                    <div class="faq-tab">
                                        <a href="/" class="qus-title">{{$layout->question_title_11}}</a>
                                        <p class="qus-des pt-10">{{$layout->question_description_11}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="ico" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6 pb-65">
                                    <div class="faq-tab">
                                        <a href="/" class="qus-title">How can I participate in the ICO Token sale?</a>
                                        <p class="qus-des pt-10">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. remaining essentially unchanged.</p>
                                    </div>
                                </div>
                                <div class="col-md-6 pb-65">
                                    <div class="faq-tab">
                                        <a href="/" class="qus-title">What is Ico Crypto?</a>
                                        <p class="qus-des pt-10">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. remaining essentially unchanged.</p>
                                    </div>
                                </div>
                                <div class="col-md-6 pb-65">
                                    <div class="faq-tab">
                                        <a href="/" class="qus-title">What cryptocurrencies can I use to purchase? </a>
                                        <p class="qus-des pt-10">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. remaining essentially unchanged.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Tokens" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6 pb-65">
                                    <div class="faq-tab">
                                        <a href="/" class="qus-title">How can I participate in the ICO Token sale?</a>
                                        <p class="qus-des pt-10">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. remaining essentially unchanged.</p>
                                    </div>
                                </div>
                                <div class="col-md-6 pb-65">
                                    <div class="faq-tab">
                                        <a href="/" class="qus-title">What cryptocurrencies can I use to purchase? </a>
                                        <p class="qus-des pt-10">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. remaining essentially unchanged.</p>
                                    </div>
                                </div>
                                <div class="col-md-6 pb-65">
                                    <div class="faq-tab">
                                        <a href="/" class="qus-title">What is Ico Crypto?</a>
                                        <p class="qus-des pt-10">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. remaining essentially unchanged.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="client" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6 pb-65">
                                    <div class="faq-tab">
                                        <a href="/" class="qus-title">How can I participate in the ICO Token sale?</a>
                                        <p class="qus-des pt-10">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. remaining essentially unchanged.</p>
                                    </div>
                                </div>
                                <div class="col-md-6 pb-65">
                                    <div class="faq-tab">
                                        <a href="/" class="qus-title">What cryptocurrencies can I use to purchase? </a>
                                        <p class="qus-des pt-10">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. remaining essentially unchanged.</p>
                                    </div>
                                </div>
                                <div class="col-md-6 pb-65">
                                    <div class="faq-tab">
                                        <a href="/" class="qus-title">How do I benefit from the ICO Token?</a>
                                        <p class="qus-des pt-10">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. remaining essentially unchanged.</p>
                                    </div>
                                </div>
                                <div class="col-md-6 pb-65">
                                    <div class="faq-tab">
                                        <a href="/" class="qus-title">What is Ico Crypto?</a>
                                        <p class="qus-des pt-10">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. remaining essentially unchanged.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="legal" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6 pb-65">
                                    <div class="faq-tab">
                                        <a href="/" class="qus-title">What cryptocurrencies can I use to purchase? </a>
                                        <p class="qus-des pt-10">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. remaining essentially unchanged.</p>
                                    </div>
                                </div>
                                <div class="col-md-6 pb-65">
                                    <div class="faq-tab">
                                        <a href="/" class="qus-title">How do I benefit from the ICO Token?</a>
                                        <p class="qus-des pt-10">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. remaining essentially unchanged.</p>
                                    </div>
                                </div>
                                <div class="col-md-6 pb-65">
                                    <div class="faq-tab">
                                        <a href="/" class="qus-title">What is Ico Crypto?</a>
                                        <p class="qus-des pt-10">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. remaining essentially unchanged.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="team-part skyblue bg-pattern pt-100 pb-55">
        <div class="container">
            <div class="row">
                <div class="col-md-12 wow fadeInUp">
                    <div class="section-heading text-center pb-65">
                        <label class="sub-heading">User Reviews</label>
                        <h2 class="heading-title">Testimonials</h2>
                        {{--                        <p class="heading-des">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>--}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 wow fadeInLeft pb-45">
                    <div class="team-box flex-align">
                        <div class="team-img">
                            <a href="/"><img src="{{url('/').'/'.$layout->testimonial_image_1}}" alt="team member"></a>
                        </div>
                        <div class="team-des">
                            <a href="/" class="member-name">{{$layout->testimonial_name_1}}</a>
                            <p class="member-des">{{$layout->testimonial_description_1}}</p>
                            <ul class="pt-15">
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pb-45 wow fadeInRight">
                    <div class="team-box flex-align">
                        <div class="team-img">
                            <a href="/"><img src="{{url('/').'/'.$layout->testimonial_image_2}}" alt="team member"></a>
                        </div>
                        <div class="team-des">
                            <a href="/" class="member-name">{{$layout->testimonial_name_2}}</a>
                            <p class="member-des">{{$layout->testimonial_description_2}}</p>
                            <ul class="pt-15">
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 wow fadeInLeft pb-45">
                    <div class="team-box flex-align">
                        <div class="team-img">
                            <a href="/"><img src="{{url('/').'/'.$layout->testimonial_image_3}}" alt="team member"></a>
                        </div>
                        <div class="team-des">
                            <a href="/" class="member-name">{{$layout->testimonial_name_3}}</a>
                            <p class="member-des">{{$layout->testimonial_description_3}}</p>
                            <ul class="pt-15">
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pb-45 wow fadeInRight">
                    <div class="team-box flex-align">
                        <div class="team-img">
                            <a href="/"><img src="{{url('/').'/'.$layout->testimonial_image_4}}" alt="team member"></a>
                        </div>
                        <div class="team-des">
                            <a href="/" class="member-name">{{$layout->testimonial_name_4}}</a>
                            <p class="member-des">{{$layout->testimonial_description_4}}</p>
                            <ul class="pt-15">
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="work-part darkblue ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12 wow fadeInUp">
                    <div class="section-heading text-center pb-65">
                        {{--                        <label class="sub-heading">what is cryptcon</label>--}}
                        <h2 class="heading-title">About us</h2>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-12 flex-align wow fadeInRight">
                    {!! $layout->about_us !!}
                </div>
            </div>
        </div>
    </section>
    <section class="work-part darkblue ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12 wow fadeInUp">
                    <div class="section-heading text-center pb-65">
                        {{--                        <label class="sub-heading">what is cryptcon</label>--}}
                        <h2 class="heading-title">Risk Disclaimer for Forex Trading</h2>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-12 flex-align wow fadeInRight">
                    {!! $layout->risk !!}
                </div>
            </div>
        </div>
    </section>
@endsection