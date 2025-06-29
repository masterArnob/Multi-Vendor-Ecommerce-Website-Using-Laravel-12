<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Product;
use App\Models\SingleCategorySection;
use App\Models\Slider;
use App\Models\TopCategorySection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $sliders = Slider::where('status', '1')->orderBy('serial', 'ASC')->get();
        $flashSaleDate = FlashSale::first();
        $flashSaleItemsSliders = FlashSaleItem::where(['status' => '1', 'show_at_home' => '1'])->orderBy('id', 'DESC')->get();
        $topCategories = TopCategorySection::first();
        $brands = Brand::where('status', 1)
        ->where('is_featured', 1)
        ->orderBy('id', 'DESC')
        ->get();

        $typeBasedProduct = $this->getTypeBasedProduct();
       // dd($typeBasedProduct);

       $singleCatOne = SingleCategorySection::first();
       $singleCatTwo = SingleCategorySection::where('id', 2)->first();
        return view('frontend.home', compact(
            'sliders', 
           'flashSaleItemsSliders',
                       'flashSaleDate',
                       'topCategories',
                       'brands',
                       'typeBasedProduct',
                       'singleCatOne',
                       'singleCatTwo',
            ));
    }


    public function getTypeBasedProduct(){
        $typeBasedProduct = [];
        
        
        
        
        $typeBasedProduct['new_arrival'] = Product::where(['status' => 1, 'is_approved' => 1, 'product_type' => 'new_arrival'])
        ->orderBy('id', 'DESC')
        ->take(8)
        ->get();

         $typeBasedProduct['featured_product'] = Product::where(['status' => 1, 'is_approved' => 1, 'product_type' => 'featured_product'])
        ->orderBy('id', 'DESC')
        ->take(8)
        ->get();


         $typeBasedProduct['top_product'] = Product::where(['status' => 1, 'is_approved' => 1, 'product_type' => 'top_product'])
        ->orderBy('id', 'DESC')
        ->take(8)
        ->get();


         $typeBasedProduct['best_product'] = Product::where(['status' => 1, 'is_approved' => 1, 'product_type' => 'best_product'])
        ->orderBy('id', 'DESC')
        ->take(8)
        ->get();

        return $typeBasedProduct;
    }
}
