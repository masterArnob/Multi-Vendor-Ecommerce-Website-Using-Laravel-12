<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request){
        //dd($request->all());
        $product = Product::findOrFail($request->product_id);

        if($product->qty === 0){
            return response(['status' => 'stockout', 'message' => 'Product Stock Out!']);
        }else if($request->qty > $product->qty){
            return response(['status' => 'qty_error', 'message' => 'Product Quantity is not available!']);
        }
      
        $variants = [];
        $variantsTotal = 0;
        $productPrice = 0;

        if($product->offer_price > 0 && $product->offer_start_date <= now() && $product->offer_end_date >= now()){
            $productPrice = $product->offer_price;
        }else{
            $productPrice = $product->price;
        }

        if($request->has('variants_items')){
            foreach($request->variants_items as $item_id){
                $variantItem = ProductVariantItem::findOrFail($item_id);
                $variants[$variantItem->productVariant->name]['name'] = $variantItem->name;
                $variants[$variantItem->productVariant->name]['price'] = $variantItem->price;
                $variantsTotal += $variantItem->price;
            }
           // dd($variantsTotal);
        }

        $cartData = [];
        $cartData['id'] = $product->id;
        $cartData['name'] = $product->name;
        $cartData['qty'] = $request->qty;
        $cartData['price'] = $productPrice;
        $cartData['weight'] = 10;
        $cartData['options']['image'] = $product->thumb_image;
        $cartData['options']['variants'] = $variants;
        $cartData['options']['variantsTotal'] = $variantsTotal;
        $cartData['options']['slug'] = $product->slug;
        //dd($cartData);

        Cart::add($cartData);
        return response(['status' => 'success', 'message' => 'product added to cart successfully']);

    }


    public function getCartCount(){
        $count = Cart::count();
        return response(['status' => 'success', 'count' => $count]);
    }


    public function cartDetails(){
        $cartItems = Cart::content();
        if(count($cartItems) === 0){
            Session::forget('coupon');
        }
        return view('frontend.pages.cart-details', compact('cartItems'));
    }


    public function updateQty(Request $request){
        //dd($request->all());
        $productId = Cart::get($request->rowid)->id;
        $product = Product::findOrFail($productId);
        if($product->qty === 0){
            return response(['status' => 'stockout', 'message' => 'Product Stock Out!']);
        }else if($request->qty > $product->qty){
            return response(['status' => 'qty_error', 'message' => 'Product Quantity is not available!']);
        }

        Cart::update($request->rowid, $request->qty); // Will update the id, name and price


        $productTotal = $this->productTotal($request->rowid);

        return response(['status' => 'success', 'message' => 'Quantity updated successfully!', 'productTotal' => $productTotal]);
    }

    public function productTotal($rowId){
        $product = Cart::get($rowId);
        $total = ($product->price + $product->options->variantsTotal) * $product->qty;
        return $total;
    }


    public function clearCart($id){
        Cart::destroy();
         notyf()->success('Cart Cleared Successfully!');
        return response(['status' => 'success']);
    }

    public function removeItem($rowid){
        Cart::remove($rowid);
        notyf()->success('Product Removed Successfully!');
        return redirect()->back();
    }


    public function getSubTotal(){
        $subTotal = getSubTotal();
        return response(['status' => 'success', 'subTotal' => $subTotal]);
    }


    public function applyCoupon(Request $request){
        //dd($request->all());
        //dd(now());
        if($request->coupon_code === null){
            return response(['status' => 'error', 'message' => 'Please enter a coupon code!']);
        }

        $coupon = Coupon::where(['status' => 1, 'code' => $request->coupon_code])->first();
        //dd($coupon);
        if($coupon === null){
            return response(['status' => 'error', 'message' => 'Coupon code is not valid']);
        }else if($coupon->start_date > now() || $coupon->end_date < now()){
            return response(['status' => 'error', 'message' => 'Coupon code is expired']);
        }else if($coupon->total_used >= $coupon->quantity){
            return response(['status' => 'error', 'message' => 'Coupon code is not available']);
        }

        if($coupon->discount_type === 'amount'){
            Session::put('coupon', [
                'name' => $coupon->name,
                'code' => $coupon->code,
                'discount' => $coupon->discount,
                'discount_type' => 'amount',
            ]);
        }else if($coupon->discount_type === 'percent'){
            Session::put('coupon', [
                'name' => $coupon->name,
                'code' => $coupon->code,
                'discount' => $coupon->discount,
                'discount_type' => 'percent',
            ]);
        }
      
        return response(['status' => 'success', 'message' => 'Coupon applied successfully!']);
    }


    public function couponCalculation(){
        //dd('working');
        $subTotal = getSubTotal();
        if(Session::has('coupon')){
            $coupon = Session::get('coupon');
            if($coupon['discount_type'] === 'amount'){
                $discount = $coupon['discount'];
                $total = $subTotal - $discount;
                return response(['status' => 'success', 'subTotal' => $subTotal, 'discount' => round($discount), 'cart_total' => round($total)]);
            }else if($coupon['discount_type'] === 'percent'){
                $discount = ($coupon['discount'] / 100) * $subTotal;
                $total = $subTotal - $discount;
                return response(['status' => 'success', 'subTotal' => $subTotal, 'discount' => round($discount), 'cart_total' => round($total)]);
            }
        }else{
              return response(['status' => 'success', 'subTotal' => $subTotal, 'discount' => 0, 'cart_total' => $subTotal]);
        }
    }
}
