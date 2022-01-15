@extends('user.dashboard.app')

@section('content')
    @php
        use App\Models\Category;
$user = \Illuminate\Support\Facades\Auth::user()

    @endphp
    @php
        $images =  explode(',', $product->gallery);
    @endphp
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Products Detail</h3>
                            </div><!-- .nk-block-head-content -->

                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="row g-gs">
                            <div class="col-xxl-12">


                                <section class="home-banner parallax" id="banner">
                                    <div class="wp-section">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div id="workCarousel" class="carousel carousel-4 slide color-two-l" data-ride="carousel">
                                                        <!-- Indicators -->
                                                        <ol class="carousel-indicators hide">
                                                            <li data-target="#homepageCarousel" data-slide-to="0" class="active"></li>
                                                        </ol>

                                                        <div class="carousel-inner">
                                                            <div class="item item-dark active">
                                                                <img src="{{url('/') . '/'. $product->image}}" alt="" class="img-responsive">
                                                            </div>
                                                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                                                <ol class="carousel-indicators">
                                                                    @php
                                                                        $first = true;
                                                                    @endphp
                                                                    @foreach($images as $key=> $image)
                                                                        <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}" class="@if($first) active @endif"></li>
                                                                        @php
                                                                            $first = false;
                                                                        @endphp
                                                                    @endforeach
                                                                </ol>
                                                                <div class="carousel-inner">
                                                                    @php
                                                                        $first = true;
                                                                    @endphp
                                                                    @foreach($images as $image)
                                                                        <div class="carousel-item @if($first) active @endif ">
                                                                            <img class="d-block w-100" src="{{url('/') . '/'. $image}}" alt="First slide">
                                                                        </div>
                                                                        @php
                                                                            $first = false;
                                                                        @endphp
                                                                    @endforeach
                                                                </div>
                                                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                    <span class="sr-only">Previous</span>
                                                                </a>
                                                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                    <span class="sr-only">Next</span>
                                                                </a>
                                                            </div>


                                                        </div>

                                                        <!-- Controls -->
                                                        <a class="left carousel-control" href="#workCarousel" data-slide="prev">
                                                            <i class="fa fa-angle-left"></i>
                                                        </a>
                                                        <a class="right carousel-control" href="#workCarousel" data-slide="next">
                                                            <i class="fa fa-angle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="section-title-wr">
                                                        <h3 class="section-title left"><span>{{$product->name}}</span></h3>
                                                    </div>
                                                    {!! $product->description !!}
                                                    @if(empty($user->subscription))
                                                        <a
                                                                href="/user/subscription"
                                                                class="
                            btn btn-primary btn-lg
                            px-4
                            py-2
                            btn-sm
                            smoothscroll
                        " style="color: white"
                                                        >Purchase</a
                                                        >
                                                    @else
                                                        <a
                                                                href="{{url('/') . '/' .$product->file}}"
                                                                class="btn btn-secondary px-4 py-2 btn-sm"
                                                        >Download</a
                                                        >
                                                    @endif
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="row">
                                                <div class="col-12">

                                                    {!! $product->video !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>


                            </div><!-- .col -->
                        </div><!-- .row -->



                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>


@endsection

