<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function payment()
    {
        $data = [];
        $data['items'] = [
            [
                'name' => 'ItSolutionStuff.com',
                'price' => 100,
                'desc'  => 'Description for ItSolutionStuff.com',
                'qty' => 1
            ]
        ];

        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['total'] = 100;

        $provider = new ExpressCheckout;

        // $response = $provider->setExpressCheckout($data);

        $response = $provider->setExpressCheckout($data, true);

        return redirect($response['paypal_link']);
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        dd('Your payment is canceled. You can create cancel page here.');
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        $paypalModule = new ExpressCheckout;

        $response = $paypalModule->getExpressCheckoutDetails($request->token);


        dd($response);
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {

        dd('Payment was successfull. The payment success page goes here!');

        }



        dd('Error occured!');
    }

    public function paypal_test(){
        $provider = new PayPalClient;

        $settings = Settings::first();
        $config = [
            'mode'    => $settings->p_mode, // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
            'sandbox' => [
                'client_id'         => $settings->p_client,
                'client_secret'     => $settings->p_secret,
                'app_id'            => '',
            ],
            'live' => [
                'client_id'         => $settings->p_client,
                'client_secret'     => $settings->p_secret,
                'app_id'            => env('PAYPAL_LIVE_APP_ID', ''),
            ],

            'payment_action' => 'Sale',
            'currency'       => 'USD',
            'notify_url'     => 'https://your-app.com/paypal/notify',
            'locale'         => 'en_US',
            'validate_ssl'   => true,
        ];
        $provider->setApiCredentials($config);

        $provider->getAccessToken();
        $subscription = $provider->showSubscriptionDetails('I-D8E70YDT6K0B');
//        $subscription = $provider->cancelSubscription('I-D8E70YDT6K0B', 'Cancelling it manually');
//        dd();
        dd($subscription);
    }
}
