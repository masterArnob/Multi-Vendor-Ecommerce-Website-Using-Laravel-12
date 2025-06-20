<?php

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

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