<div id="paypal-button-container-{{$p_subscription}}"></div>
<script src="https://www.paypal.com/sdk/js?client-id=Ab8WywhFsL0kn4h75c_L2E6bG8nHBCN7hwNlsEy0jPWJc4AuHW-8pAaFvxg6WU6tV7zBAqimnO03VMnX&vault=true&intent=subscription" data-sdk-integration-source="button-factory"></script>
<script>
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
            alert(data.subscriptionID); // You can add optional success message for the subscriber here
        }
    }).render('#paypal-button-container-{{$p_subscription}}'); // Renders the PayPal button
</script>