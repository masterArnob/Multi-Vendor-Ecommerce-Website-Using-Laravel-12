<?php

namespace App\Http\Controllers;

use App\Models\OrderProduct;
use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Order;
use App\Models\Product;
use App\Models\Settings;
use App\Models\Transaction;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SslCommerzPaymentController extends Controller
{



    public function index(Request $request)
    {
        //dd('yes');
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = finalCost(); # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";



        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }


    public function success(Request $request)
    {
        //dd('success');
        //echo "Transaction is Successful";

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = 'BDT';

        $sslc = new SslCommerzNotification();

        //order
        $this->storeOrder($tran_id, $amount, $currency, 'sslcommerz', '1');
        //order

        $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);
        //dd($validation);
        if ($validation === true) {
            $this->clearSessions();
            return view('frontend.pages.payment.success');
        } else {
            return view('frontend.pages.payment.failed');
        }

    }


    public function clearSessions()
    {
        Cart::destroy();
        Session::forget('shippingAddress');
        Session::forget('shipping_rule');
        Session::forget('coupon');
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
        $order->currency_name = 'BDT';
        $order->currency_icon = '৳';
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

    

    public function cancel(Request $request)
    {
        return view('frontend.pages.payment.failed');
    }


    public function fail(Request $request)
    {
        return view('frontend.pages.payment.failed');

    }



}
