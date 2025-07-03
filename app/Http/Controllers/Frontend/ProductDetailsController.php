<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Brand;
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
       
        //dd($request->all());
        if($request->has('category')){
            $slug = $request->category;
            $category = Category::where('slug', $slug)->first();
            //dd($category->id);
            $products = Product::where(['category_id' => $category->id, 'status' => 1, 'is_approved' => 1])
            ->when($request->has('range'), function($query) use($request){
                $range = explode(';', $request->range);
                if(count($range) == 2){
                $min = $range[0];
                $max = $range[1];
                return $query->whereBetween('price', [$min, $max]);
                }
            })
            ->paginate(12);
           
        }else if($request->has('sub_category')){
            $slug = $request->sub_category;
            $sub_category = SubCategory::where('slug', $slug)->first();
            //dd($category->id);
            $products = Product::where(['sub_category_id' => $sub_category->id, 'status' => 1, 'is_approved' => 1])
              ->when($request->has('range'), function($query) use($request){
                $range = explode(';', $request->range);
                if(count($range) == 2){
                $min = $range[0];
                $max = $range[1];
                return $query->whereBetween('price', [$min, $max]);
                }
            })
            ->paginate(12);
        }else if($request->has('child_category')){
            $slug = $request->child_category;
            $child_category = ChildCategory::where('slug', $slug)->first();
            //dd($category->id);
            $products = Product::where(['child_category_id' => $child_category->id, 'status' => 1, 'is_approved' => 1])
              ->when($request->has('range'), function($query) use($request){
                $range = explode(';', $request->range);
                if(count($range) == 2){
                $min = $range[0];
                $max = $range[1];
                return $query->whereBetween('price', [$min, $max]);
                }
            })
            ->paginate(12);
        }else if($request->has('brand_slug')){
            $brand = Brand::where('slug', $request->brand_slug)->first();
            $products = Product::where(['brand_id' => $brand->id, 'status' => 1, 'is_approved' => 1])
              ->when($request->has('range'), function($query) use($request){
                $range = explode(';', $request->range);
                if(count($range) == 2){
                $min = $range[0];
                $max = $range[1];
                return $query->whereBetween('price', [$min, $max]);
                }
            })
            ->orderBy('id', 'DESC')
            ->paginate(12);
        }else if($request->has('search')){
            $products = Product::where(['status' => 1, 'is_approved' => 1])
            ->where(function($query) use($request){
                $query->where('name', 'LIKE', '%'.$request->search.'%')
                        ->orWhere('short_description', 'LIKE', '%'.$request->search.'%')
                         ->orWhere('long_description', 'LIKE', '%'.$request->search.'%')
                         ->orWhereHas('category', function($query) use($request){
                            $query->where('name', 'LIKE', '%'.$request->search.'%');
                         })
                        ->orWhereHas('brand', function($query) use($request){
                            $query->where('name', 'LIKE', '%'.$request->search.'%');
                         });

            })
             ->when($request->has('range'), function($query) use($request){
                $range = explode(';', $request->range);
                if(count($range) == 2){
                $min = $range[0];
                $max = $range[1];
                return $query->whereBetween('price', [$min, $max]);
                }
            })
            ->orderBy('id', 'DESC')
            ->paginate(12);
        }else{
            $products = Product::where(['status' => 1, 'is_approved' => 1])
            ->when($request->has('range'), function($query) use($request){
                $range = explode(';', $request->range);
                if(count($range) == 2){
                $min = $range[0];
                $max = $range[1];
                return $query->whereBetween('price', [$min, $max]);
                }
            })
            ->orderBy('id', 'DESC')
            ->paginate(12);
        }
        $categories = Category::where('status', 1)->orderBy('id', 'DESC')->get();
        $brands = Brand::where('status', 1)->orderBy('id', 'DESC')->get();
        
         $product_list_ad = Advertisement::where('key', 'home_page_banner_six')->first();
         
        return view('frontend.pages.product-list', 
         compact(
            'products', 
            'categories',
            'brands',
            'product_list_ad'
        ));
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
         $product_ad_one = Advertisement::where('key', 'home_page_banner_five')->first();
         return view('frontend.pages.product-details', compact('product', 'flashSaleDate', 'product_ad_one'));
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
