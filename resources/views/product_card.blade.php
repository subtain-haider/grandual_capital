<div class="item">
    <a href="/product/{{$product->id}}">
    <div class="wp-block product">
        <figure>
            <img alt="" src="{{url('/') . '/'. $product->image}}" class="img-responsive img-center">
            {{--                                <span class="ribbon base">New</span>--}}
        </figure>
        <h2 class="product-title">{{$product->name}}</h2>
        <p>
            {{$product->one_description}}
        </p>
{{--        <div class="wp-block-footer">--}}
{{--            --}}{{--                                <span class="price pull-left">RON 233.33</span>--}}


{{--                <a href="/product/{{$product->id}}" class="btn btn-sm btn-base btn-icon btn-cart pull-right">--}}
{{--                    <span>Get product</span>--}}
{{--                </a>--}}
{{--        </div>--}}
    </div>
    </a>
</div>