<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AdminVendorProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class VendorProductVariant extends Controller
{
    
    public function index(AdminVendorProductVariantDataTable $dataTable, $product_id){
        //dd($product_id);
        $product = Product::findOrFail($product_id);
        return $dataTable->render('admin.vendor-product.product-variant.index', compact('product'));
    }




    public function edit($product_id, $variant_id){
        //dd($product_id);
        //dd($variant_id);
        $product = Product::findOrFail($product_id);
        $variant = ProductVariant::findOrFail($variant_id);
        return view('admin.vendor-product.product-variant.edit', compact('product', 'variant'));
    }

    public function update(Request $request, $variant_id){
        //dd($variant_id);
        //dd($request->all());
           $request->validate([
            'name' => ['required'],
            'status' => ['required']
        ]);

        $variant = ProductVariant::findOrFail($variant_id);
        $variant->name = $request->name;
        $variant->status = $request->status;
        $variant->save();
        notyf()->success('Variant Updated Successfully!');
        return redirect()->route('admin.vendor-product-variant.index', ['product_id' => $request->product_id]);
    }


    public function destroy($id){
        //dd($id);
        $variant = ProductVariant::findOrFail($id);
        $items = ProductVariantItem::where('product_variant_id', $variant->id)->count();
        if($items > 0){
            notyf()->error('There are items under this variant. Please delete them first!');
            return response(['status' => 'error']);
        }

        $variant->delete();
        notyf()->success('Variant Deleted Successfully!');
        return response(['status' => 'success']);
    }
}
