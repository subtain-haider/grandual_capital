<meta name="csrf-token" content="{{ Session::token() }}">

<div style=" width: 40%; margin: auto; margin-top: 10%" id="paypal-button-container-{{$p_subscription}}"></div>
<script src="https://www.paypal.com/sdk/js?client-id={{$setting->p_client}}&vault=true&intent=subscription" data-sdk-integration-source="button-factory"></script>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    paypal.Buttons({
        style: {
            shape: 'rect',
            color: 'gold',
            layout: 'vertical',
            label: 'subscribe'
        },
        createSubscription: function(data, actions) {
            return actions.subscription.create({
                /* Creates the subscription */
                plan_id: '{{$p_subscription}}'
            });
        },
        onApprove: function(data, actions) {
            var paypal_subscription_id = data.subscriptionID;
            var subscription_id = {{$subscription_id}};
            $.ajax({
                type:'POST',
                url:"{{ route('paypal_modal_success') }}",
                data:{subscription_id:subscription_id, paypal_subscription_id:paypal_subscription_id},
                success:function(){
                    window.location.href = "/user/subscription";
                }
            });
            alert(); // You can add optional success message for the subscriber here
        }
    }).render('#paypal-button-container-{{$p_subscription}}'); // Renders the PayPal button
</script>