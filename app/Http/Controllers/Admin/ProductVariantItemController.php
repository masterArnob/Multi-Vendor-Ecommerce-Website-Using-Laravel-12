<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AdminProductVariantItemDataTable;
use App\DataTables\ProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductVariantItemController extends Controller
{
        public function index(AdminProductVariantItemDataTable $dataTable, $product_id, $variant_id){
        //dd($product_id);
        $product = Product::findOrFail($product_id);
        $variant = ProductVariant::findOrFail($variant_id);
       return $dataTable->render('admin.product.product-variant-item.index', compact('product', 'variant'));
    }


        public function create($product_id, $variant_id){
       // dd($product_id);
         $product = Product::findOrFail($product_id);
        $variant = ProductVariant::findOrFail($variant_id);
        return view('admin.product.product-variant-item.create', compact('product', 'variant'));
    }

    public function store(Request $request){
        //dd($request->all());
        $request->validate([
            'name' => 'required',
            'price' => ['required'],
            'status' => ['required'],
            'is_default' => ['required']
        ]);

        $item = new ProductVariantItem();
        $item->name = $request->name;
        $item->price = $request->price;
        $item->status = $request->status;
        $item->is_default = $request->is_default;
        $item->product_variant_id = $request->variant_id;
        $item->product_id = $request->product_id;
        $item->admin_id = Auth::user()->id;
        $item->vendor_id = 0;
        $item->save();
        notyf()->success('Variant Item Created Successfully!');
        return redirect()->route('admin.product-variant-item.index', ['product_id' => $request->product_id, 'variant_id' => $request->variant_id]);
    }



        public function edit($product_id, $variant_id, $variant_item_id){
       // dd($product_id);
         $product = Product::findOrFail($product_id);
        $variant = ProductVariant::findOrFail($variant_id);
        $variant_item = ProductVariantItem::findOrFail($variant_item_id);
        return view('admin.product.product-variant-item.edit', compact('product', 'variant', 'variant_item'));
    }

    public function update(Request $request, $variant_item_id){
        //dd($request->all());
            $request->validate([
            'name' => 'required',
            'price' => ['required'],
            'status' => ['required'],
            'is_default' => ['required']
        ]);

        $item = ProductVariantItem::findOrFail($variant_item_id);
        $item->name = $request->name;
        $item->price = $request->price;
        $item->status = $request->status;
        $item->is_default = $request->is_default;
        $item->product_variant_id = $request->variant_id;
        $item->product_id = $request->product_id;
        $item->save();
        notyf()->success('Variant Item Updated Successfully!');
        return redirect()->route('admin.product-variant-item.index', ['product_id' => $request->product_id, 'variant_id' => $request->variant_id]);
    }

    public function destroy($id){
        //dd($id);
        $item = ProductVariantItem::findOrFail($id);
        $item->delete();
        notyf()->success('Variant Item Deleted Successfully!');
        return response(['status' => 'success']);
    }
}
