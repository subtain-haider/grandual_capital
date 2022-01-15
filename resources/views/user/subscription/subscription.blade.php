@extends('user.dashboard.app')
@section('content')
    @php
        $settings = \App\Models\Settings::first();
    @endphp


 <!-- content @s -->
 <div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Packages</h3>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                @if(session()->has('success'))
                                    <div class="alert alert-success" role="alert">
                                        Subscription bought successfully.
                                    </div>
                                @endif
                                <div class="nk-block-des text-soft">
                                    <p>Choose your pricing plan and start enjoying our service.</p>
                                </div>
                            </div>
                        </div>
                    </div><!-- .nk-block-head -->
                    <div class="row g-gs">
                        @foreach ($subscriptions as $subscription)
                        <div class="col-md-4 col-xxl-3">
                            <div class="card card-bordered pricing text-center">
                                <div class="pricing-body">
                                    <div class="pricing-media">
                                        <img src="{{asset('admin/images/icons/plan-s1.svg')}}" alt="">
                                    </div>
                                    <div class="pricing-title w-220px mx-auto">
                                        <h5 class="title">{{$subscription->name}} Month</h5>
                                    </div>
                                    <div class="pricing-amount">
                                        <div class="amount">
                                            <p>First Month: ${{$subscription->price}}</p>
                                            <p>Recurring Amount: ${{$subscription->r_fee}}</p>
                                        </div>
                                        <span class="bill">{{$subscription->desc}}</span>
                                    </div>
                                    <div class="pricing-action">
                                        @if($user->p_subscription_id == $subscription->id)
                                            <a class="btn btn-success  " >Current Subscription</a>
                                        @else
                                        @if($settings->p_status)
{{--                                            <a  target="_blank" href="/paypal_modal/{{$subscription->id}}" class="btn btn-primary mt-3">Paypal</a>--}}
                                            <a href="/user/subscribe/{{$user->id}}/{{$subscription->id}}" class="btn btn-primary mt-3">Paypal ${{$subscription->price}}</a>
                                        @endif
                                        @if($settings->s_status)
                                            <button class="btn btn-primary mt-3" onclick="stripe_fnc({{$subscription->id}})" id="checkout-button" data-id="{{$subscription->id}}">Stripe ${{$subscription->price}}</button>
                                        @endif
                                        @if($settings->b_status)
                                        <button href="/user/subscribe/{{$user->id}}/{{$subscription->id}}" class="btn btn-primary cryptochill-button  mt-3"
                                                data-amount="{{$subscription->price}}"
                                                data-currency="USD"
                                                data-product="{{$subscription->name}} Months"
                                                data-passthrough="{{$subscription->id}}"
                                                data-show-payment-url="true"
                                        >Bitcoin ${{$subscription->price}} </button>
                                    @endif
                                @endif
                                    </div>
                                </div>
                            </div><!-- .pricing -->
                        </div><!-- .col -->

                        @endforeach
                        
                    </div>
                </div><!-- .nk-block -->


            </div>
        </div>
    </div>
</div>
<!-- content @e -->



              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
{{--                              <h5 class="modal-title" id="exampleModalLabel">Select any method for payment</h5>--}}
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                              <div class="card card-nav-tabs card-plain">
                                  <div class="card-body" id="paypal_modal">

                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
      </div>
   </div>
</div>
<script type="text/javascript">
    function paypal_modal(subscription_id){
        $.get("/paypal_modal/" + subscription_id, function(data, status){

            $('#paypal_modal').html(data)
        });
    }
    // Create an instance of the Stripe object with your publishable API key
    var stripe = Stripe("{{\App\Models\Settings::first()->s_client}}");
    var checkoutButton = document.getElementById("checkout-button");
    function stripe_fnc(id) {
        var data = id;
        fetch("/checkout_session", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({subscription_id: data})
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (session) {
                return stripe.redirectToCheckout({ sessionId: session.id });
            })
            .then(function (result) {
                // If redirectToCheckout fails due to a browser or network
                // error, you should display the localized error message to your
                // customer using error.message.
                if (result.error) {
                    alert(result.error.message);
                }
            })
            .catch(function (error) {
                console.error("Error:", error);
            });
    };
</script>
<script src="https://static.cryptochill.com/static/js/sdk.js"></script>
<script>

    function onPaymentSuccess(data, code) {

        $.post("{{route('bitcoin_success')}}",
            {
                _token: $('meta[name="csrf-token"]').attr('content'),
                data: data,
            },
            function(data, status){
                // console.log('done')
                // location.reload();
                return false;
            });
    }

    CryptoChill.setup({
        account: "{{\App\Models\Settings::first()->b_client}}",
        profile: "{{\App\Models\Settings::first()->b_secret}}",

        // Event callbacks
        // onOpen: onPaymentOpen,
        onSuccess: onPaymentSuccess,
        // onCancel: onPaymentCancel
    })
</script>
@endsection
