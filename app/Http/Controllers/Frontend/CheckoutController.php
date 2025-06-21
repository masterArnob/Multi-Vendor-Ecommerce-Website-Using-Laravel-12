<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ShippingRule;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index(){
        $addresses = UserAddress::where(['user_id' => Auth::user()->id])->orderby('id', 'DESC')->get();
        $rules = ShippingRule::where('status', 1)->get();
        return view('frontend.pages.checkout', compact('addresses', 'rules'));
    }


    public function checkoutFormSubmit(Request $request){
        //dd($request->all());
        $request->validate([
            'shipping_rule_id' => ['required', 'numeric'],
            'shipping_address_id' => ['required', 'numeric']
        ]);

        $shippingRule = ShippingRule::findOrFail($request->shipping_rule_id);
        $shippingAddress = UserAddress::findOrFail($request->shipping_address_id)->toArray();

        if($shippingRule){
            Session::put('shipping_rule', [
                'id' => $shippingRule->id,
                'name' => $shippingRule->name,
                'type' => $shippingRule->type,
                'cost' => $shippingRule->cost
            ]);
        }

        if($shippingAddress){
            Session::put('shippingAddress', $shippingAddress);
        }

        return response(['status' => 'success', 'message' => 'saved', 'redirect_url' => route('user.payment.index')]);
    }
}
