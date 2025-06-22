<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PaymentSettings;
use App\Models\Product;
use App\Models\Settings;
use App\Models\Transaction;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function index()
    {
        return view('frontend.pages.payment.index');
    }


    public function payWithPaypal()
    {
        $provider = new PayPalClient;
        $provider->getAccessToken();

        $paymentSettings = PaymentSettings::all()->pluck('value', 'key')->toArray();

        $total = finalCost();
        $payableAmount = $total * ($paymentSettings['paypal_rate'] ?? 1);

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

        if (isset($response['id']) && $response['id'] !== null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect($link['href']);
                }
            }
        }
    }

    public function paypalSuccess(Request $request)
    {
        // dd($request->all());
        $provider = new PayPalClient;
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            // Payment was successful, you can process the order here
            // For example, you can save the order details to the database
            // and redirect the user to a success page.
            $capture = $response['purchase_units'][0]['payments']['captures'][0];
            $tansactionId = $capture['id'];
            $amount = $capture['amount']['value'];
            $currency = $capture['amount']['currency_code'];
            $this->storeOrder($tansactionId, $amount, $currency, 'paypal', '1');
            $this->clearSessions();

            notyf()->success('Payment is Successfull!');
            return redirect()->route('user.payment.success');
        } else {
            notyf()->error('Payment is Failed!');
            return redirect()->route('user.payment.failed');
        }
    }


    public function paypalCancel()
    {
        notyf()->success('Something went wrong!');
        return redirect()->route('user.payment.index');
    }


    public function paymentSuccess()
    {
        return view('frontend.pages.payment.success');
    }

    public function paymentFailed()
    {
        return view('frontend.pages.payment.failed');
    }



    public function storeOrder($tansactionId, $amount, $currency, $payment_method, $paid_amount)
    {
        $settings = Settings::first();
        $order = new Order();
        $order->invoice_id = time() . '-' . rand(1000, 9999);
        $order->transaction_id = $tansactionId;
        $order->user_id = Auth::user()->id;
        $order->sub_total = getSubTotal();
        $order->amount = $amount;
        $order->currency_name = $settings->currency_name;
        $order->currency_icon = $settings->currency_icon;
        $order->product_qty = Cart::content()->count();
        $order->payment_method = $payment_method;
        $order->payment_status = 1;
        $order->order_address = json_encode(Session::get('shippingAddress'));
        $order->shipping_method = json_encode(Session::get('shipping_rule'));
        $order->coupon = json_encode(Session::get('coupon'));
        $order->order_status = 'pending';
        $order->save();

        $items = Cart::content();
        foreach ($items as $item) {
            $product = Product::findOrFail($item->id);
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id;
            $orderProduct->transaction_id = $tansactionId;
            $orderProduct->product_id = $product->id;
            $orderProduct->vendor_id = $product->vendor_id;
            $orderProduct->product_name = $product->name;
            $orderProduct->variants = json_encode($item->options->variants);
            $orderProduct->variant_total = $item->options->variantsTotal;;
            $orderProduct->unit_price = $item->price;
            $orderProduct->qty = $item->qty;

            $updateQty = ($product->qty - $item->qty);
            $product->qty = $updateQty;
            $product->save();

            $orderProduct->save();
        }

        $transaction = new Transaction();
        $transaction->order_id = $order->id;
        $transaction->transaction_id = $tansactionId;
        $transaction->payment_method = $payment_method;
        $transaction->amount = $amount;
        $transaction->amount_real_currency = $paid_amount;
        $transaction->amount_real_currency_name = $currency;
        $transaction->save();
    }

    public function clearSessions()
    {
        Cart::destroy();
        Session::forget('shippingAddress');
        Session::forget('shipping_rule');
        Session::forget('coupon');
    }


    public function payWithStripe()
    {
        //srtipe client secret
        //Stripe::setApiKey();
        //srtipe client secret
        $clientSecret = PaymentSettings::where('key', 'stripe_client_secret')->first();
        $stripeRate = PaymentSettings::where('key', 'stripe_rate')->first();
        $stripeCurrency = PaymentSettings::where('key', 'stripe_currency')->first();
        if (!$clientSecret) {
            notyf()->error('Stripe Client Secret is not set!');
            return redirect()->route('user.payment.index');
        }
         Stripe::setApiKey($clientSecret->value);

        $payableAmount = (finalCost() * 100) * $stripeRate->value; // Convert to cents
        $quantityCount = 1 ;
        $response = StripeSession::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => $stripeCurrency->value,
                        'product_data' => [
                            'name' => 'Product'
                        ],
                        'unit_amount' => $payableAmount
                    ],
                    'quantity' => $quantityCount
                ]
            ],
            'mode' => 'payment',
            'success_url' => route('user.payment.stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('user.payment.stripe.cancel')
        ]);

        return redirect()->away($response->url);
    }


    public function stripeSuccess(Request $request) {
          $clientSecret = PaymentSettings::where('key', 'stripe_client_secret')->first();
        Stripe::setApiKey($clientSecret->value);
        
        $response = StripeSession::retrieve($request->session_id);
        if($response->payment_status === 'paid') {
            $transactionId = $response->payment_intent;
            $mainAmount = finalCost();
            $paidAmount = $response->amount_total / 100;
            $currency = $response->currency;

            try {
     
                //order
            $this->storeOrder($transactionId, $mainAmount, $currency, 'stripe', '1');
            $this->clearSessions();
                //order

                return redirect()->route('user.payment.success');
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        return redirect()->route('user.payment.failed');
    }

    public function stripeCancel() {
        return redirect()->route('user.payment.failed');
    }
}
