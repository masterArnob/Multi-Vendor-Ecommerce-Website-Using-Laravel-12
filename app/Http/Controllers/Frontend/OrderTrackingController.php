<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderTrackingController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('invoice_id')) {
            $order = Order::where('invoice_id', $request->invoice_id)->first();
             return view('frontend.pages.order-track', compact('order'));
        }else{
            $order = null;
             return view('frontend.pages.order-track', compact('order'));
        }   
       
    }
}
