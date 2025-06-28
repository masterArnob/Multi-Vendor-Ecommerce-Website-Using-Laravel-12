<?php

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

function getSubTotal(){
    $total = 0;
    foreach(Cart::content() as $item){
        $total += ($item->price + $item->options->variantsTotal) * $item->qty;
    }
    return $total;
}



    function mainCartTotal(){
        //dd('working');
          $subTotal = getSubTotal();
        if(Session::has('coupon')){
            $coupon = Session::get('coupon');
            if($coupon['discount_type'] === 'amount'){
                $discount = $coupon['discount'];
                $total = $subTotal - $discount;
                return round($total);
            }else if($coupon['discount_type'] === 'percent'){
                $discount = ($coupon['discount'] / 100) * $subTotal;
                $total = $subTotal - $discount;
                return round($total);
            }else{
                return $subTotal; 
            }
        }else{
                return $subTotal; 
    }
    }


    
    function discount(){
        //dd('working');
        if(Session::has('coupon')){
            $coupon = Session::get('coupon');
            $subTotal = getSubTotal();
            if($coupon['discount_type'] === 'amount'){
                $discount = $coupon['discount'];
                return round($discount);
            }else if($coupon['discount_type'] === 'percent'){
                $discount = ($coupon['discount'] / 100) * $subTotal;
                return round($discount);
            }else{
                return 0; 
            }
        }else{
            return 0;
        }
    }


    function shippingFee(){
        if(Session::has('shipping_rule')){
            $cost = Session::get('shipping_rule')['cost'];
            return $cost;
        }else{
            return 0;
        }
    }


    function finalCost(){
        $total = mainCartTotal();
        $shippingFee = shippingFee();
        $finalCost = ($total + $shippingFee);
        return round($finalCost);
    }


    function limitText($text, $limit = 20){
        return Str::limit($text, $limit, '...');
    }