<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
class PaymentController extends Controller
{
    public function index(){
        return view('frontend.pages.payment.index');
    }


public function payWithPaypal()
{
    $provider = new PayPalClient;
    $provider->getAccessToken();

    $payableAmount = finalCost();

    $response = $provider->createOrder([
        'intent' => 'CAPTURE',
        'application_context' => [
            'return_url' => route('user.payment.paypal.success'),
            'cancel_url' => route('user.payment.paypal.cancel'),
        ],
        'purchase_units' => [
            [
                'amount' => [
                    'currency_code' => config('paypal.currency'),
                    'value' => $payableAmount,
                ]
            ]
        ]
    ]);

    //dd($response);

    if(isset($response['id']) && $response['id'] !== null){
        foreach($response['links'] as $link){
            if($link['rel'] === 'approve'){
                return redirect($link['href']);
            }
        }
    }
}

    public function paypalSuccess(Request $request){
       // dd($request->all());
    $provider = new PayPalClient;
    $provider->getAccessToken();
    $response = $provider->capturePaymentOrder($request->token);
    if(isset($response['status']) && $response['status'] === 'COMPLETED'){
        // Payment was successful, you can process the order here
        // For example, you can save the order details to the database
        // and redirect the user to a success page.
        $capture = $response['purchase_units'][0]['payments']['captures'][0];
        $tansactionId = $capture['id'];
        $amount = $capture['amount']['value'];
        $currency = $capture['amount']['currency_code'];
        notyf()->success('Payment is Successfull!');
        return redirect()->route('user.payment.success');
    } else {
        notyf()->error('Payment is Failed!');
        return redirect()->route('user.payment.failed');
    }
}


    public function paypalCancel(){
        notyf()->success('Something went wrong!');
        return redirect()->route('user.payment.index');
    }


    public function paymentSuccess(){
        return view('frontend.pages.payment.success');
    }

    public function paymentFailed(){
        return view('frontend.pages.payment.failed');
    }
}
