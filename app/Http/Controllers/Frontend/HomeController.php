<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use App\Models\Advertisement;
use App\Models\Brand;
use App\Models\Category;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\FooterSection;
use App\Models\Product;
use App\Models\SingleCategorySection;
use App\Models\Slider;
use App\Models\TopCategorySection;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $sliders = Slider::where('status', '1')->orderBy('serial', 'ASC')->get();
        $flashSaleDate = FlashSale::first();
        $flashSaleItemsSliders = FlashSaleItem::where(['status' => '1', 'show_at_home' => '1'])->orderBy('id', 'DESC')->get();
        $topCategories = TopCategorySection::first();
        $brands = Brand::where(['status' => 1, 'is_featured' => 1])
        ->orderBy('id', 'DESC')
        ->get();
  

        $typeBasedProduct = $this->getTypeBasedProduct();
       // dd($typeBasedProduct);

       $singleCatOne = SingleCategorySection::first();
       $singleCatTwo = SingleCategorySection::where('id', 2)->first();
       $singleCatThree = SingleCategorySection::where('id', 3)->first();
       $footer = FooterSection::first();
       $home_page_banner_one = Advertisement::where('key', 'home_page_banner_one')->first();
       $home_page_banner_two = Advertisement::where('key', 'home_page_banner_two')->first();
       $home_page_banner_three = Advertisement::where('key', 'home_page_banner_three')->first();
       $home_page_banner_four = Advertisement::where('key', 'home_page_banner_four')->first();
     
        return view('frontend.home', compact(
            'sliders', 
           'flashSaleItemsSliders',
                       'flashSaleDate',
                       'topCategories',
                       'brands',
                       'typeBasedProduct',
                       'singleCatOne',
                       'singleCatTwo',
                       'singleCatThree',
                       'footer',
                       'home_page_banner_one',
                       'home_page_banner_two',
                       'home_page_banner_three',
                       'home_page_banner_four',
             
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


    public function vendorList(){
        $vendors = User::where(['role' => 'vendor', 'vendor_status' => 'approved'])
        ->orderBy('id', 'DESC')
        ->paginate(10);
        return view('frontend.pages.vendor-list', compact('vendors'));
    }


    public function vendorDetails($vendor_id){
        $vendor = User::findOrFail($vendor_id);
        $products = Product::where(['status' => 1, 'is_approved' => 1, 'vendor_id' => $vendor_id])
        ->orderBy('id', 'DESC')
        ->paginate(10);

          $categories = Category::where('status', 1)->orderBy('id', 'DESC')->get();
        $brands = Brand::where('status', 1)->orderBy('id', 'DESC')->get();
        
        return view('frontend.pages.vendor-details', compact('vendor', 'products', 'categories', 'brands'));
    }


    public function aboutPage(){
        $content = json_decode(AboutPage::where('key', 'content')->first()->value);
        return view('frontend.pages.about-page', compact('content'));
    }
}
