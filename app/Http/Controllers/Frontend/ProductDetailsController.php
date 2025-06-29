<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\FlashSale;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       
        if($request->has('category')){
            $slug = $request->category;
            $category = Category::where('slug', $slug)->first();
            //dd($category->id);
            $products = Product::where(['category_id' => $category->id, 'status' => 1, 'is_approved' => 1])->paginate(12);
           
        }else if($request->has('sub_category')){
            $slug = $request->sub_category;
            $sub_category = SubCategory::where('slug', $slug)->first();
            //dd($category->id);
            $products = Product::where(['sub_category_id' => $sub_category->id, 'status' => 1, 'is_approved' => 1])->paginate(12);
        }else if($request->has('child_category')){
            $slug = $request->child_category;
            $child_category = ChildCategory::where('slug', $slug)->first();
            //dd($category->id);
            $products = Product::where(['child_category_id' => $child_category->id, 'status' => 1, 'is_approved' => 1])->paginate(12);
        }
         return view('frontend.pages.product-list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        $flashSaleDate = FlashSale::first();
         return view('frontend.pages.product-details', compact('product', 'flashSaleDate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
