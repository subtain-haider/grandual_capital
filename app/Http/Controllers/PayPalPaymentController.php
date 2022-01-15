<?php

namespace App\Http\Controllers;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalPaymentController extends Controller
{
    public function handlePayment($sub)
    {
        $subscription = Subscription::find($sub);
        $product = [];
        $product['items'] = [
            [
                'name' => $subscription->name,
                'price' => $subscription->price,
                'desc'  => $subscription->desc,
                'qty' => 1
            ]
        ];

        $product['invoice_id'] = 1;
        $product['invoice_description'] = "Order #{$product['invoice_id']} Bill";
        $product['return_url'] = route('success.payment');
        $product['cancel_url'] = route('cancel.payment');
        $product['total'] = $subscription->price;

        $paypalModule = new ExpressCheckout;

        $res = $paypalModule->setExpressCheckout($product);
        $res = $paypalModule->setExpressCheckout($product, true);

        return redirect($res['paypal_link']);
    }

    public function paymentCancel()
    {
        dd('Your payment has been declend. The payment cancelation page goes here!');
    }

    public function paymentSuccess(Request $request)
    {
        $paypalModule = new ExpressCheckout;
        $response = $paypalModule->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            dd('Payment was successfull. The payment success page goes here!');
        }

        dd('Error occured!');
    }
}