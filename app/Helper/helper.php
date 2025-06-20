<?php

use Gloudemans\Shoppingcart\Facades\Cart;

function getSubTotal(){
    $total = 0;
    foreach(Cart::content() as $item){
        $total += ($item->price + $item->options->variantsTotal) * $item->qty;
    }
    return $total;
}