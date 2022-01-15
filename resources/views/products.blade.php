@php
    $layout = \App\Models\Front::first()->layout;
@endphp
@extends('layouts.'.$layout)

@section('content')



    <section class="home-banner parallax" id="banner">
        <div class="container">
        <div class="section-title-wr">
            <h3 class="section-title left"><span>
                        {{ (request()->is('allproducts')) ? 'All products' : 'Featured products' }}
                        </span></h3>
            <br>

        </div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#profile_0" type="button" role="tab" aria-controls="home" aria-selected="true">All</a>
                </li>
                @foreach($categories as $category)
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile_{{$category->id}}" type="button" role="tab" aria-controls="profile" aria-selected="false">{{$category->category}}</a>
                </li>
                @endforeach
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="profile_0" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-md-3">
                                @include('product_card')
                            </div>
                        @endforeach
                    </div>
                </div>
                @foreach($categories as $category)
                    <div class="tab-pane fade " id="profile_{{$category->id}}" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            @foreach($category->products as $product)
                                <div class="col-md-3">
                                    @include('product_card')
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>



        @if(request()->is('f_products'))
            <div class="row">
                <div class="col text-center">
                    <a href="/allproducts" class="btn btn-success btn-lg">View All</a>
                </div>
            </div>
        @endif


    </div>
    </section>


@endsection