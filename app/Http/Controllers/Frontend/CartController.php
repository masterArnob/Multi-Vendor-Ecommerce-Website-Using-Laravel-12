<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

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
}
