<?php

namespace App\Http\Controllers\Vendor;

use App\DataTables\VendorProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductVariantController extends Controller
{
        public function index(VendorProductVariantDataTable $dataTable, $product_id){
        //dd($product_id);
        $product = Product::findOrFail($product_id);
        if($product->vendor_id != Auth::user()->id){
            abort(404);
        }
        return $dataTable->render('vendor.product.product-variant.index', compact('product'));
    }

    public function create($product_id){
       // dd($product_id);
         $product = Product::findOrFail($product_id);
        if($product->vendor_id != Auth::user()->id){
            abort(404);
        }
        return view('vendor.product.product-variant.create', compact('product'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required'],
            'status' => ['required']
        ]);

        $variant = new ProductVariant();
        $variant->name = $request->name;
        $variant->status = $request->status;
        $variant->admin_id = 0;
        $variant->vendor_id = Auth::user()->id;
        $variant->product_id = $request->product_id;
        $variant->save();
        notyf()->success('Variant Created Successfully!');
        return redirect()->route('vendor.product-variant.index', ['product_id' => $request->product_id]);
    }

    public function edit($product_id, $variant_id){
        //dd($product_id);
        //dd($variant_id);
        $product = Product::findOrFail($product_id);
        if($product->vendor_id != Auth::user()->id){
            abort(404);
        }
        $variant = ProductVariant::findOrFail($variant_id);
        return view('vendor.product.product-variant.edit', compact('product', 'variant'));
    }

    public function update(Request $request, $variant_id){
        //dd($variant_id);
        //dd($request->all());
           $request->validate([
            'name' => ['required'],
            'status' => ['required']
        ]);

        $variant = ProductVariant::findOrFail($variant_id);
        if($variant->vendor_id != Auth::user()->id){
            abort(404);
        }
        $variant->name = $request->name;
        $variant->status = $request->status;
        $variant->product_id = $request->product_id;
        $variant->save();
        notyf()->success('Variant Updated Successfully!');
        return redirect()->route('vendor.product-variant.index', ['product_id' => $request->product_id]);
    }


    public function destroy($id){
        //dd($id);
        $variant = ProductVariant::findOrFail($id);
        //dd($variant);
        if($variant->vendor_id != Auth::user()->id){
            abort(404);
        }

        $variant->delete();
        notyf()->success('Variant Deleted Successfully!');
        return response(['status' => 'success']);
    }
}
